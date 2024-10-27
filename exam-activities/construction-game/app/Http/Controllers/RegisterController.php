<?php

namespace App\Http\Controllers;

use App\Models\UserBBDD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $user = new UserBBDD();
        $user->nombre = $request->username;
        $user->password = Hash::make($request->password);
        $user->rol = 1;
        $user->save();

        session()->put('user', $user);
      
        return redirect()->route('login')->with('success',
         'Successfully registered. Log in to your account');
    }
    
}
