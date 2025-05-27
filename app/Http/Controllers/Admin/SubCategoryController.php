<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class SubCategoryController extends Controller
{
    //
    public function insertSubCategory(Request $req)
    {
        $subcategory = $req->validate([
            'subcategory_name' => 'required|unique:subcategories,subcategory_name',
            'category_id' => 'required|exists:categories,id',
            'subcategory_slug'=> 'required|max:255',
            'subcategory_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);

        if (Auth::check() && Auth::user()->role === 'admin') {
        if($req->hasFile('subcategory_image')){
            $fileName = $req->file('subcategory_image')->getClientOriginalName();
            $path = $req->file('subcategory_image')->storeAs('subcategory_images', $fileName, 'public');
            $subcategory['subcategory_image'] = $path; // <-- Save path to DB
        }
            $sub =  Subcategory::create($subcategory);
           return response()->json([
                'status' => 200,
                'message' => 'Subcategory added successfully',
                'subcategory' => $sub
            ]);
        } else {
            return redirect()->back()->with('error', 'You do not have permission to add subcategories.');
        }

    }

   public function showAll(Request $request){
    $categoryId = $request->input('category_id');
    $data = Category::with('subcategories')->find($categoryId);
    if (!$data) {
        return response()->json([
            'status' => 404,
            'message' => 'Category not found',
            'data' => null
        ]);
    }
    return response()->json([
        'status' => 200,
        'data' => $data
    ]);
}

public function deleteCategory($id){
    $subcategory = Subcategory::find($id);
    if (!$subcategory) {
        return response()->json([
            'status' => 404,
            'message' => 'Subcategory not found',
        ]);
    }

    $subcategory->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Subcategory deleted successfully',
    ]);
}
}


