<?php

namespace App\Http\Controllers;

use App\Models\UserBBDD;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
/**
 * @author Nabil L. A.
 */
class RegisterController extends Controller{

    protected $userRepository;

    public function __construct(){
        $this->userRepository = new UserRepository();
    }


    /**
     * Function to show the register form
     */
    public function showRegister(){
        return view('register');
    }

    /**
     * Function to register a user
     */
    public function register(Request $request) {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|confirmed',
        ]);

        $user = new UserBBDD();
        $user->setName($request->username);
        $user->setPassword(Hash::make($request->password));
        $user->setRol('usuario');


        if (!$this->checkIfUsernameIsAvailable($user)){
            return redirect()->route('register')->with('message',
            'Your username is not available. Please use another one');
        }

        $this->userRepository->save($user);
    
        return redirect()->route('login')->with('message',
        'Successfully registered. Log in to your account');
    }

    /**
     * Function to check if the username is avalaible
     */
    function checkIfUsernameIsAvailable($user){
        $allUsers = $this->userRepository->findAll();

        foreach($allUsers as $u){
            if($u->getName() == $user->getName()){
                return false;
            }
        }

        return true;
    }


}
