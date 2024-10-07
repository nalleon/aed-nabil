<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{


    public function writeMessage(Request $request){
        $filePath = storage_path('app/messages.csv');
        $id = $this->createId($filePath);

        $userId= $request->input('userId');
        $username = $request->input('username');
        $message = $request->input('message');

        $newMessage = new Message();
        $newMessage->setId($id);
        $newMessage->setUser($username);
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
        
        return redirect('/main')->with(['userId' => $userId, 'username' => $username]);
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
        return redirect('/main');
    }

    public function getAllMessages(Request $request) {
        $filePath = storage_path('app/messages.csv');
        $allUserMessages = [];
        $userId = $request->input('userId');
        $username = $request->input('username');

        if (!file_exists($filePath)) {
            return view('main', compact('allUserMessages', 'userId', 'username'));
        }

        if (($open = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($open, 1000, ',')) !== false) {
                if (count($data) == 3) {
                    $message = new Message();
                    $message->setId((int)$data[0]);
                    $message->setUser($data[1]);
                    $message->setMessage($data[2]);
                    $allUserMessages[] = $message;
                }
            }
            fclose($open);
        }

        return view('main', compact('allUserMessages', 'userId', 'username'));
    }



}
