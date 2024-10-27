<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller{

    public function checkUser(){
        if(!session()->has('user')){
            $user = session()->get('user');

            if($user->getRol()!= 'admin') {
                return redirect()->route('login')->send();
            }
        }
    }

    public function index(){
        $this->checkUser();
        return view('adminhome');
    }


    

}
