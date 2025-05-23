<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function storeAddress(Request $request){
        $address = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|string|max:255',
            'type' => 'required|string|in:home,work,other',

        ]);

        $address['user_id'] = auth()->id(); // Assuming you have user authentication

        $add = Address::create($address);

        if($add){
            return redirect()->back()->with('success', 'Address added successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Failed to add address.');
        }

    }
}
