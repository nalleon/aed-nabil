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
        $fileaccess = $request->input('fileaccess');
        //dd($fileaccess);
        $content = $request->input('content');

        if($fileaccess == 'private'){
            $filename = date('Y-m-d_H:i:s').'_'.$username.'.txt';

            Storage::makeDirectory("/".$username . "/". $filename, 700, true);
            //Storage::put("/".$username . "/". $filename, $content);

            //dd("created test");
        } else {
            Storage::put("/".$filename. ".txt", $content);
        }
    }
}
