<?php

namespace App\Http\Controllers;

use App\DAO\UserBBDDDAO;
use App\Models\UserBBDD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller{

    protected $userDAO;

    public function __construct(){
        $this->userDAO = new UserBBDDDAO(); 
    }


    public function showRegister(){
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|confirmed',
        ]);


        $user = new UserBBDD();
        $user->setName($request->username);
        $user->setPassword(Hash::make($request->password));
        $user->setRol('usuario');

        $this->userDAO->save($user);

        session()->put('user', $user);
      
        return redirect()->route('login')->with('message',
         'Successfully registered. Log in to your account');
    }
    
}
