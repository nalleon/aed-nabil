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

      
        return redirect()->route('login')->with('success',
         'Successfully registered. Log in to your account');
    }
    
}
