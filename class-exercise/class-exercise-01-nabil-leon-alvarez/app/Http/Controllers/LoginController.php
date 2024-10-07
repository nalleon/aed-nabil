<?php

namespace App\Http\Controllers;
use App\Models\UserModel;

use Illuminate\Http\Request;

class LoginController extends Controller
{


   public function createUser(Request $request){
    $filePath = storage_path('app/users.csv');

    $username = $request->input('username');
    $id = $this->createId($filePath);

    $newUser = new UserModel();
    $newUser->setId($id);
    $newUser->setUsername($username);

    $open = fopen($filePath, 'a');
        if($open){
            fputcsv($open, [
                        $newUser->getId(),
                        $newUser->getUsername()
                    ]);
            fclose($open);
        }
        
        $request->session()->put('newUser', $newUser);

        return view('main', compact('newUser'));
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

   public function getUser(Request $request){
        $filePath = storage_path('app/users.csv');
    

        $id = $request->input('id');


        if(!file_exists($filePath)){
            return redirect('/');
        }

        $auxUser = null;

        if(($open = fopen($filePath, 'r')) !== false){
            while(($data = fgetcsv($open, 1000, ',')) !== false){
                    if($data[0]== $id){
                        $auxUser = new UserModel();
                        $auxUser->setId($data[0]);
                        $auxUser->setUsername($data[1]);
                        break;
                    }
            }
        }

        return view('main', compact('auxUser'));

    }

}
