<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Address;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function submitOrder(Request $request){
        $request->validate([
            'payment_method' => 'required|string|in:cod,razorpay,upi',
             'address_id' => 'required|exists:addresses,id',
        ]);

    $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart')->with('error', 'Cart is empty');
    }

    $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->product_price);

    $order = Orders::create([
        'user_id' => auth()->id(),
        'address_id' => $request->address_id,
        'payment_method' => $request->payment_method,
        'status' => $request->status ?? 'pending',
        'total' => $total,
    ]);




    foreach ($cartItems as $items){
        $order->orderItems()->create([
            'product_id' => $items->product->id,
            'quantity' => $items->quantity,
            'price' => $items->product->product_price,
        ]);
    }
        CartItem::where('user_id', auth()->id())->delete();

        return $request->payment_method === 'cod'
        ? redirect()->route('placedOrder')->with('success', 'Order placed successfully.')
        : redirect()->route('razorpay.pay', $order->id);

    

    }
}
