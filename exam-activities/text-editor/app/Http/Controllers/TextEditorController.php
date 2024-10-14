<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TextEditorController extends Controller
{
    /**
     * for each file
     * mkdir ->  filename
     *       ---> 2024-10-14_14:48:30_username.txt
     *
     */


    public function checkUser(Request $request){
        if(!isset($request->user)){
            redirect('/login');
        }
    }

    public function writeText(Request $request){
        $this->checkUser($request);

        $username = $request->input('username');

        $filename = $request->input('filename');
        $content = $request->content;



        Storage::makeDirectory("/".$username . "/". $filename . ".txt", 700, true);
        Storage::put("/".$username . "/". $filename . ".txt", $content);



        $filename = date('Y-m-d_H:i:s').'_'.$request->user->getUsername().'.txt';
        //dd($filename);

    }
}
