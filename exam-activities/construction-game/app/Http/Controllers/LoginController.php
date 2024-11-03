<?php

namespace App\Http\Controllers;

use App\DAO\UserBBDDDAO;
use App\DAO\UserFileDAO;
use Illuminate\Http\Request;
use App\Repository\UserRepository;

use Illuminate\Support\Facades\Hash;

/**
 * @author Nabil L. A. (nalleon)
 */
class LoginController extends Controller {

    protected $userDAO;
    protected $userRepository;
    protected $userFileDAO;

    public function __construct(){
        $this->userDAO = new UserBBDDDAO(); 
        $this->userRepository = new UserRepository();
        $this->userFileDAO = new UserFileDAO();
    }

    /**
     * Function to show thhe login view
     */
    public function showLogin(){
        return view('login');
    }

    /**
     * Funciton to check if an user exist to login
     */
   public function loginUser(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = $this->userRepository->findByName($request->input('username'));

        

        if (!$user) {
            return redirect()->route('login')->with('message', 'User does not exist');
        }


        if($this->isRoot($user)){
            return redirect()->route('adminhome');
        }

        
        $hashedPassword = $user->getPassword();
        

        if (Hash::check($request->password, $hashedPassword)) {
            session()->regenerate();
            session()->put('user', $user);
            $username = $user->getName();
            session()->put('username', $username);
            
            $this->checkIfUserExistsInFile($user);

            if ($user->getRol() == 2 || $user->getRol() == 'admin') {
                return redirect()->route('adminhome');
            } else {
                return redirect()->route('userhome');
            }
            
        } else {
            return redirect()->route('login')->with('message', 'Invalid password provided');
        }
        
   }

    /**
     * Function to logout a user
     */

    public function logout(){
        session()->flush();
        session()->regenerate();
    
        $message = 'You have successfully logged out. Log in again to access your boards.';

        return redirect()->route('login')->with('message', $message);
    }

    /**
     * Function to check if the user trying to log is root
     */

    public function isRoot($user){

        if ($user->getName() !== 'root') {
            return false;
        }

        if ($user->getPassword() !== '1q2w3e4r') {
            return false;
        }

        session()->put('user', $user);
        $username = $user->getName();
        session()->put('username', $username);
        return true;
    }

    /**
     * Function to check if the user exists in the file backup
     */
    public function checkIfUserExistsInFile($user){
        $users = $this->userFileDAO->findAll();
        
        $auxCounter = 0;
        foreach ($users as $userFile){
            if($userFile !== $user){
                $auxCounter++;
            }
        }

        if($auxCounter == count($users)){
            $this->userFileDAO->save($user);
        }

    }


}