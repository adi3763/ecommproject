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
        if (!(Auth::check() && Auth::user()->role === 'admin')) {
            return response()->json([
                'status' => 403,
                'message' => 'You do not have permission to add subcategories.'
            ], 403);
        }

        $validator = \Validator::make($req->all(), [
            'subcategory_name' => 'required|unique:subcategories,subcategory_name',
            'category_id' => 'required|exists:categories,id',
            'subcategory_slug'=> 'required|max:255',
            'subcategory_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $subcategory = $validator->validated();

        if($req->hasFile('subcategory_image')){
            $fileName = $req->file('subcategory_image')->getClientOriginalName();
            $path = $req->file('subcategory_image')->storeAs('subcategory_images', $fileName, 'public');
            $subcategory['subcategory_image'] = $path;
        }

        $sub = Subcategory::create($subcategory);
        return response()->json([
            'status' => 200,
            'message' => 'Subcategory added successfully',
            'subcategory' => $sub
        ]);
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


