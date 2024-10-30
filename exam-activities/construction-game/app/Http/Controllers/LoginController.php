<?php

namespace App\Http\Controllers;

use App\Models\UserBBDD;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @author Nabil L. A. (nalleon)
 */
class LoginController extends Controller
{

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


        $pdo = DB::getPdo();
        $st = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :nombre");
        $st->execute([':nombre' => $request->username]);

        $user = $st->fetch();

        if (!$user) {
            return redirect()->route('login')->with('message', 'User does not exist');
        }

        $hashedPassword = $user['password'];
        if (Hash::check($request->password, $hashedPassword)) {
            session()->put('user', $user);
            $username = $user['nombre'];
            session()->put('username', $username);

            if ($user['rol'] == 2) {
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


}