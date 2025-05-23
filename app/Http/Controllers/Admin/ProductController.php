<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    //
   public function showProductPage(){
    if (Auth::check() && Auth::user()->role === 'admin') {
            // Fetch all categories and subcategories
            $categories = Category::all();
            // Pass the data to the view
        return view('Admin.product', ['categories'=> $categories]);
        } 
        else {
        return redirect()->route('admin.login')->with('error', 'Please log in first.');
    }

}

public function showSubcategory($category_id){
        // Fetch all categories and subcategories
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        // Pass the data to the view
        return response()->json($subcategories);    

}


public function insertProduct(Request $request){
    $cred = $request->validate([
        'productname' => 'required|string',
        'product_price'=> 'required',
        'product_discription'=> 'required',
        'product_quantity'=> 'required',
        'product_size' =>'required',
        'category_id'=> 'required',
        'subcategory_id'=> 'required',
    ]);

    // Validate images if present
    if ($request->hasFile('product_images')) {
        $request->validate([
            'product_images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
    }

    if(Auth::check() && Auth::user()->role === 'admin') {
        $product = Product::create($cred);

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $photo) {
                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/photos'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'product_image' => 'uploads/photos/' . $filename
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product added successfully!');
    } else {
        return redirect()->route('admin.login')->with('error', 'You do not have permission.');
    }
}

public function showProductList($subcategory_id){
    $productList = Product::where('subcategory_id', $subcategory_id)->get();
    if(empty($productList)){
        return response()->json(['message' => 'No products found for this subcategory.'], 404);
    } else {
        return response()->json($productList);
    }   
}

public function editProduct($id){
$categories = Category::all();
$product = Product::findOrFail($id);
$subcategory = Subcategory::find($product->subcategory_id);

return view('Admin.productEdit', compact('product', 'categories', 'subcategory'));
}

public function updateProduct(Request $request, $id){
    $product = Product::findOrFail($id);
    $product->update($request->all());

    if ($request->hasFile('product_images')) {
        foreach ($request->file('product_images') as $photo) {
            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/photos'), $filename);

            ProductImage::create([
                'product_id' => $product->id,
                'product_image' => 'uploads/photos/' . $filename
            ]);
        }
    }

    return redirect()->back()->with('success', 'Product updated successfully!');

}

public function deleteProduct($id){
    $product = Product::findOrFail($id);
    $product->delete();

    // Optionally, delete associated images
    $images = ProductImage::where('product_id', $id)->get();
    foreach ($images as $image) {
        if (file_exists(public_path($image->product_image))) {
            unlink(public_path($image->product_image));
        }
        $image->delete();
    }

    return response()->json(['message' => 'Product deleted successfully!'], 200);

}

}
