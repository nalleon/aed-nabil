<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;


class LoginController extends Controller
{
     public function createUser(Request $request){

        $filePath = storage_path('app/users.csv');
        $username = trim($request->input('username'));


        if($username == 'public' || $username == '' || $username == '/'){
            return redirect()->route('login');
        }

        $userExists = $this->getUserIfExists($username, $filePath);

        if($userExists !== null){
            session(['user' => $userExists]);
            session()->regenerate();
            return redirect('/text-editor');
        }


        $id = $this->createId($filePath);

        $newUser = new UserModel();
        $newUser->setId($id);
        $newUser->setUsername($username);

        $user = $newUser;

        session(['user' => $user]);
        session()->regenerate();


        $open = fopen($filePath, 'a');
        if($open){
            fputcsv($open, [
                        $newUser->getId(),
                        $newUser->getUsername()
                    ]);
            fclose($open);
        }

        return redirect()->route('startpage');
    }



   public function createId($filePath){
        $id = 0;
        if(file_exists($filePath)){
            $open = fopen($filePath, 'r');
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if(isset($data[0])){
                    $actualId = (int)$data[0];
                    $id = max($id, $actualId);
                }
            }
            fclose($open);
        }
        return $id+1;
   }

   public function getUserIfExists($username, $filePath){
        if(!file_exists($filePath)){
            return redirect('/');
        }

        $auxUser = null;

        if (($open = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($open, 1000, ',')) !== false) {
                if (isset($data[1]) && $data[1] == $username) {
                    $auxUser = new UserModel();
                    $auxUser->setId($data[0]);
                    $auxUser->setUsername($data[1]);
                    fclose($open);
                    return $auxUser;
                }
            }
        }

        return null;

    }

    public function logout(){
        session()->flush();
        session()->regenerate();
        $message = 'You have successfully logged out. Log in again to access the editor.';

        return redirect()->route('login')->with
        ('message', $message);
    }

}
