<?php

namespace App\Http\Controllers;
use App\Models\UserModel;

use Illuminate\Http\Request;

class LoginController extends Controller
{

   public function createUser(Request $request){
        $filePath = storage_path('app/users.csv');

        $username = $request->input('username');

        $userExists = $this->getUserIfExists($username, $filePath);
        if($userExists !== null){
            session(['user' => $userExists]);
            return redirect('/main');
        }
        
        $id = $this->createId($filePath);
        $newUser = new UserModel();
        $newUser->setId($id);
        $newUser->setUsername($username);

        session(['user' => $newUser]);

        $open = fopen($filePath, 'a');
        if($open){
            fputcsv($open, [
                        $newUser->getId(),
                        $newUser->getUsername()
                    ]);
            fclose($open);
        }
            
        return redirect('/main');
    }



   public function createId($filePath){
    if(file_exists($filePath)){
        $open = fopen($filePath, 'r');
        $id = 1;
        while (($data = fgetcsv($open, 1000, ','))!== false) {
            if(isset($data[0])){
                $actualId = (int)$data[0];
            }
            $id = max($id, $actualId);
        }
        fclose($open);
        return $id+1;
    }
    return 1;
   }

   public function getUserIfExists($username, $filePath){

        if(!file_exists($filePath)){
            return redirect('/');
        }

        $auxUser = null;

        if (($open = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($open, 1000, ',')) !== false) {
                if (isset($data[1]) && $data[1]== $username) {
                    $auxUser = new UserModel();
                    $auxUser->setId($data[0]);
                    $auxUser->setUsername($data[1]);
                    return $auxUser;
                }
            }
            fclose($open);
        }

        return null;

    }

}
