<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TextEditorController extends Controller
{
    public function checkUser(){
        if(!session()->has('user')){
            return redirect()->route('login')->send();
        }
    }


    public function showTextEditor(){
        $this->checkUser();

        $user = session('user');
        $username = $user->getUsername();

        $directories = Storage::directories($username);
        $publicDirectories = Storage::directories('public');

        return view('text-editor', compact('username', 'directories', 'publicDirectories'));
    }

    public function writeText(Request $request){
        $this->checkUser();

       
        $filename = $request->input('filename');

        if (!preg_match('/^[a-zA-Z0-9]+$/', $filename)) {
            $message = 'Use a valid name for the file without special characters.';
            return redirect()->route('startpage')->with(compact('message'));
        }

        $content = $request->input('content');
        
        if (trim($content) === '') {
            $message = 'The content cannot be empty.';
            return redirect()->route('startpage')->with(compact('message'));
        }

        $username = $request->input('username');
        $fileaccess = $request->input('fileaccess');

        $directory=$username . "/" . $filename;
        date_default_timezone_set('Atlantic/Canary');
        $filenameToCreate = date('Y-m-d_H-i-s').'_'.$username . ".txt";

        if($fileaccess == 'private'){
            Storage::makeDirectory($directory, 700, true);
            Storage::put($directory ."/". $filenameToCreate, $content);
        } else {
            $directory = $filename;
            date_default_timezone_set('Atlantic/Canary');
            $filenameToCreate = date('Y-m-d_H-i-s').'_'.$username . ".txt";
            Storage::put("/public/". $directory . "/" . $filenameToCreate, $content);
        }

        return redirect()->route('startpage');
    }

    public function showDirectoryFiles($type, $directory){
        $username = session('user')->getUsername();

        $directoryPath = $username . '/' . $directory;

        if($type == 'public'){
           $directoryPath = $type . '/' . $directory;
        }

        $files = Storage::files($directoryPath);

        rsort($files);

        $recentFile = $files[0];
        $content = Storage::get($recentFile);

        return view('directory-files', compact('directory', 'files',
        'recentFile', 'content'));
    }


    public function editFile(Request $request){
        $this->checkUser();

        $file = $request->input('filename');
        $content = Storage::get($file);

        $arr = explode('_', $file);
        $aux = $arr[2];

        $arrAux = explode('.', $aux);
        $username = $arrAux[0];

        $fileTypeArr = explode('/', $file);
        
        if ($fileTypeArr[0] !== 'public'){
            $userSession = session()->get('user');
            $usernameSession = $userSession->getUsername();

            if($usernameSession!= $username){
                abort(403, 'Unauthorized action.');
            }
        }
       

        return view('edit-files', compact('file', 'content'));
    }

    public function updateFile(Request $request){
        $this->checkUser();

        $userSession = session()->get('user');
        $usernameSession = $userSession->getUsername();

        $filename = $request->input('filename');
        $content = $request->input('content');
        $arr = explode('/', $filename);
        $arrDirectory = $arr;
        $directory = $arrDirectory[0] . '/' . $arrDirectory[1];
        $arrUserName = $usernameSession . '.txt';

        date_default_timezone_set('Atlantic/Canary');
        $fileNameDate = date('Y-m-d_H-i-s').'_'. $arrUserName;

        Storage::put($directory . '/' . $fileNameDate, $content);
        return redirect()->route('startpage');
    }


}
