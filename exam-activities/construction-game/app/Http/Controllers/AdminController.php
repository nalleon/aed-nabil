<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller{

    protected $userRepository;

    public function __construct(){
        $this->userRepository = new UserRepository();
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
        $usersArray = $this->userRepository->findAll();

        return view('manageusers', compact('usersArray'));
    }

    public function editUser($id){
        $this->checkUser();

        $userEdit = $this->userRepository->findById($id);
        return view('edituser', compact('userEdit'));
    }
    
    public function updateUser(Request $request, $id){
        $this->checkUser();
    
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', 
            'role' => 'required|string',
        ]);

        $user = $this->userRepository->findById($id);

        if ($user === null) {
            return redirect()->route('manageusers')->with('message', 'User not found.');
        }

        $user->setName($request->input('username'));
        
        if ($request->password) {
            $user->setPassword(Hash::make($request->input('password'))); 
        }

        $user->setRol(1);

        if ($request->input('role') === '2') {
            $user->setRol(2);
        } 


        $this->userRepository->update($user);

        return redirect()->route('manageusers')->with('message', 'User updated successfully.');
    }

    public function deleteUser($id){
        $this->checkUser();

        if ($this->userRepository->delete($id)) {
            return redirect()->route('manageusers')->with('message', 'User deleted successfully.');
        } else {
            return redirect()->route('manageusers')->with('message', 'User could not be deleted.');
        }
    }


}
