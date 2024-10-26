<?php

namespace App\Http\Controllers;

use App\Models\UserBBDD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'username' => 'required|string|max:255|unique:usuarios,nombre',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = UserBBDD::create([
            'nombre' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        session_start();
        session()->put('user', $user);
      
        return redirect()->route('login')->with('success',
         'Successfully registered. Log in to your account');
    }
    
}
