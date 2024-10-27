<?php

namespace App\Http\Controllers;

use App\DAO\UserBBDDDAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller{

    protected $userDAO;

    public function __construct(){
        $this->userDAO = new UserBBDDDAO;
    }

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

    public function showUsers(){
        $this->checkUser();
        $usersArray = $this->userDAO->findAll();

        return view('manageusers', compact('usersArray'));
    }
    

}
