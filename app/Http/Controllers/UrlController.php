<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\subcategory;
use App\Models\Product;
use App\Models\CartItem;

class UrlController extends Controller
{

    public function showLoginPage()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Redirect admin to the dashboard if already logged in
            return redirect()->route('admin.dashboard');
        }
        elseif (Auth::check() && Auth::user()->role === 'user') {
            // Redirect user to their home page if already logged in
            return redirect()->route('user.home');
        }
    
        return view('Admin.login');    }

   public function showDashboardPage()
    {
        if(Auth::check()){
            $user = Auth::user();
            $products = Product::count();
            return view('Admin.dashboard', [
                'data'=> $user,
                'products' => $products,
        ]);   
     }else{
        return redirect()->route('admin.login')->with('error', 'Please login first.');
     }
    }


    public function showUserHomePage()
    { 
        if (Auth::check() && Auth::user()->role === 'admin') {
        // Redirect admin to the dashboard if they try to access the user home page
        $categories = Category::with('subcategories')->get();
        return redirect()->route('admin.dashboard',);
    }

    if (Auth::check() && Auth::user()->role === 'user') {
        // Show the user home page
                $categories = Category::with('subcategories')->get();

        return view('user',[
            'categories' => $categories,
        ]);
    }

    return redirect()->route('admin.login')->with('error', 'Please log in first.');

    }

    public function redirectUser()
{
    if (!Auth::check()) {
        return redirect()->route('admin.login');
    }

    $user = Auth::user();

    if (Gate::allows('is-admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (Gate::allows('is-user')) {
        return redirect()->route('user.home');
    }

    abort(403, 'Unauthorized.');
}

public function showCategoryPage()
{
    if (Auth::check() && Auth::user()->role === 'admin') {
        $data = Category::with('subcategories')->get();  // Fetch all categories or relevant data
        return view('Admin.catogery', ['data'=> $data]);
    } else {
        return redirect()->route('admin.login')->with('error', 'Please log in first.');
    }
    
 
}

// public function showTestingPage()
// {
//     if (Auth::check() && Auth::user()->role === 'admin') {
//         $data = Category::with('subcategory')->get(); // Fetch all categories or relevant data
//         return view('Admin.testing-page');
//         } else {
//         return redirect()->route('admin.login')->with('error', 'Please log in first.');
//     }
// }

public function showShopByCategoryPage($id)
{
    if (Auth::check() && Auth::user()->role === 'user') {
        $data = Category::with(['product', 'subcategories','product.productimage'])->findOrFail($id);
        return view('WebsitePages.shopByCategory', ['data'=> $data]);
    } else {
        return redirect()->route('admin.login')->with('error', 'Please log in first.');
    }

}

public function buyProductPage($category, $slug, $id)
{
    if (Auth::check() && Auth::user()->role === 'user') {
        $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();

        $product = Product::with(['category', 'subcategory', 'productimage'])->findOrFail($id);
        return view('WebsitePages.product', ['product' => $product, 'cartItems' => $cartItems]);
    } else {
        return redirect()->route('admin.login')->with('error', 'Please log in first.');
    }

}

public function showAddressPage()
{
    if (Auth::check() && Auth::user()->role === 'user') {
        $address = Address::where('user_id', auth()->id())->get();
        $cartItems = CartItem::with(['product.productimage'])->where('user_id', auth()->id())->get();


       if ($address->isEmpty()) {
    return view('WebsitePages.addressForm');
} else {
    return view('WebsitePages.reviewPage', ['addresses'=> $address, 'cartItems'=> $cartItems]);
}
        
    } else {
        return redirect()->route('admin.login')->with('error', 'Please log in first.');
    }

}

public function showOrderPage()
{
    if (Auth::check() && Auth::user()->role === 'user') {
        return view('WebsitePages.orderReview');
    } else {
        return redirect()->route('admin.login')->with('error', 'Please log in first.');
    }


}

public function showRegisterPage(){
    return view('createAccount');

}

}