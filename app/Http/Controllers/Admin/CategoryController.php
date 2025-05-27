<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    public function insertCategory(Request $req)
    {
        $category = $req->validate([
            'category_name' => 'required|unique:categories,category_name',
            'slug' => 'required|max:255',
            'images' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);

        if (Auth::check() && Auth::user()->role === 'admin') {
         if($req->hasFile('images')){
        $file = $req->file('images');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('category_images', $fileName, 'public');
        $category['images'] = $path; // Save path to DB
    }
            Category::create($category);
            return redirect()->back()->with('success', 'Category added successfully.');
        } else {
            return redirect()->back()->with('error', 'You do not have permission to add categories.');
        }
    }

    // Public function showCategory(){
    //    $data = Category::all(); // Fetch all categories or relevant data
    //     return view('Admin.catogery', compact('data'));
    // }
}

