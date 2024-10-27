<?php

namespace App\Http\Controllers;

use App\DAO\UserBBDDDAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function editUser($id){
        $this->checkUser();

        $userEdit = $this->userDAO->findById($id);
        //dd($userEdit->getRol());
        return view('edituser', compact('userEdit'));
    }
    
    public function updateUser(Request $request, $id){
        $this->checkUser();
    
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', 
            'role' => 'required|string',
        ]);

        $user = $this->userDAO->findById($id);

        if ($user === null) {
            return redirect()->route('manageusers')->with('message', 'User not found.');
        }

        $user->setName($request->input('username'));
        
        if ($request->password) {
            $user->setPassword(Hash::make($request->input('password'))); 
        }

        $user->setRol(1);

        if ($request->input('role') === 'admin') {
            $user->setRol(2);
        }

        $this->userDAO->update($user);

        return redirect()->route('manageusers')->with('message', 'User updated successfully.');
    }

    public function deleteUser($id){
        $this->checkUser();

        if ($this->userDAO->delete($id)) {
            return redirect()->route('manageusers')->with('message', 'User deleted successfully.');
        } else {
            return redirect()->route('manageusers')->with('message', 'User could not be deleted.');
        }
    }


}
