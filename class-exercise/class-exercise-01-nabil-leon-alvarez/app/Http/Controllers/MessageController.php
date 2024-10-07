<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\UserModel;

class MessageController extends Controller
{


    public function writeMessage(Request $request){
        $filePath = storage_path('app/messages.csv');
        $id = $this->createId($filePath);

        $username = $request->input('username');
        $userId = $request->input('userId');

        $user = new UserModel();
        $user->setId($userId);
        $user->setUsername($username);

        $message = $request->input('message');

        $newMessage = new Message();
        $newMessage->setId($id);
        $newMessage->setUser($user);
        $newMessage->setMessage($message);

        $open = fopen($filePath, 'a');
        if($open){
            fputcsv($open, [
                        $newMessage->getId(),
                        $newMessage->getUser(),
                        $newMessage->getMessage()
                    ]);
            fclose($open);
        }

        return view('main', compact('newMessage'));
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

    public function getMessage(Request $request){
        $id = $request->input('id');

        $filePath = storage_path('app/messages.csv');

        if(!file_exists($filePath)){
            return redirect('/');
        }

        $auxMessage = null;

        if(($open = fopen($filePath, 'r')) !== false){
            while(($data = fgetcsv($open, 1000, ',')) !== false){
                    if($data[0]== $id){
                        $auxMessage = new Message();
                        $auxMessage->data[0];
                        $auxMessage->data[1];
                        $auxMessage->data[2];
                    }
            }
        }

    }

    public function getAllMessages(Request $request){
        $filePath = storage_path('app/messages.csv');

        if(!file_exists($filePath)){
            return redirect()->route('main');
        }

        $allUserMessages = [];


        if(($open = fopen($filePath, 'r') )!== false){
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if(count($data) == 3){
                    $allUserMessages[] = new Message(

                    );

                }
            }
            fclose($open);
            return view('main', compact('allUserMessages'));
        }
    }



}
