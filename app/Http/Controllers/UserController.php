<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //

    public function loginCheck(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            if(auth()->user()->role === 'admin'){
            // Authentication passed...
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        }
    elseif(auth()->user()->role === 'user'){
            // Authentication passed...
            return redirect()->route('user.home')->with('success', 'Login successful!');
        }
    }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session_abort();
        return redirect()->route('admin.login')->with('success','');
    }
}
