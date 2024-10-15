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
        $content = $request->input('content');

        $directory=$username . "/" . $filename;
        $filenameToCreate = date('Y-m-d_H-i-s').'_'.$username . ".txt";


        if($fileaccess == 'private'){
            Storage::makeDirectory($directory, 700, true);
            Storage::put($directory ."/". $filenameToCreate, $content);
        } else {
            Storage::put("/public/".$filenameToCreate, $content);
        }
    }
}