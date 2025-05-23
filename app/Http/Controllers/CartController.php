<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;

class CartController extends Controller
{
    //
    public function index(){
         $cartItems = CartItem::with(['product.productimage'])->where('user_id', auth()->id())->get();
    return view('WebsitePages.cartpage', compact('cartItems'));
    }

    public function addToCart(Request $request){
    $productId = $request->input('product_id');
    $userId = auth()->id();

    $cartItem = CartItem::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity');
    } else {
        CartItem::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => 1
        ]);
    }
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function updateCart(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        ]);

        $cartitem = CartItem::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();   
        if($cartitem){
            $cartitem->quantity = $request->quantity;
            $cartitem->save();
            return redirect()->back()->with('success', 'Cart updated successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Cart item not found.');
        }
    }

    public function deleteCartItem(Request $request){
        $cartitem = CartItem::where('user_id', auth()->id())->where('product_id',$request->product_id)->first();
        if($cartitem){
            $cartitem->delete();
            return redirect()->back()->with('success', 'Cart item deleted successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Cart item not found.');
        }
    }
}
