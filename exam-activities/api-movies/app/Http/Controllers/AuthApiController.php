<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
    public function register(Request $request)   {
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        ]);
        return auth('api')->login($user);
    }

    public function login(Request $request) {
        $nom = $request->input('name');
        $pass = $request->input('password');
        $user = User::where('name', '=', $nom)->first();

        if(isset($user) ){
            $usuarioname = $user['name'];
            $usuariohashpass = $user['password'];
            if ( Hash::check($pass, $usuariohashpass )) {
                $token = JWTAuth::fromUser($user);
                return $token;
            } else {
                return response()->json(['error' => 'Unauthorized', $nom => $pass], 401);
            }
        } else {
            return response()->json(['error' => 'User not found', $nom => $pass], 401);
        }
    }
}
