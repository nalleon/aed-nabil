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
            return redirect()->route('login');
        }
    }

    public function writeText(Request $request){
        $this->checkUser($request);

        //session(['user' => $newUser]);

        $username = $request->input('username');
        $filename = $request->input('filename');
        $fileaccess = $request->input('fileaccess');
        $content = $request->input('content');

        $directory=$username . "/" . $filename;
        date_default_timezone_set('Atlantic/Canary');
        $filenameToCreate = date('Y-m-d_H-i-s').'_'.$username . ".txt";

        if($fileaccess == 'private'){
            Storage::makeDirectory($directory, 700, true);
            Storage::put($directory ."/". $filenameToCreate, $content);
        } else {
            $directory = "files";
            date_default_timezone_set('Atlantic/Canary');
            $filenameToCreate = date('Y-m-d_H-i-s').'_'. $filename.'_'.$username . ".txt";
            Storage::put("/public/". $directory . "/" . $filenameToCreate, $content);
        }
    }

    public function showDirectoryFiles($directory){
        $username = session('user')->getUsername();

        $directoryPath = $username . '/' . $directory;
        $files = Storage::files($directoryPath);

        $sortedFiles = collect($files)->sortByDesc(function ($file) {
            return basename($file);
        });

        //rsort
        $files = $sortedFiles;

        return view('directory-files', compact('directory', 'files'));
    }

    public function showPublicDirectoryFiles($directory){
        $username = session('user')->getUsername();

        $directoryPath = 'public/files';
        $files = Storage::files($directoryPath);

        $sortedFiles = collect($files)->sortByDesc(function ($file) {
            return basename($file);
        });

        $files = $sortedFiles;

        return view('directory-public-files', compact('directory', 'files'));
    }




    public function editFile(Request $request){
        $this->checkUser($request);

        $file = $request->input('filename');
        $content = Storage::get($file);


        $arr = explode('_', $file);
        $aux = $arr[2];
      
        $arrAux = explode('.', $aux);
        $username = $arrAux[0];
        
        $userSession = session()->get('user');
        $usernameSession = $userSession->getUsername();

        if($usernameSession!= $username){
            abort(403, 'Unauthorized action.');
        }

        return view('edit-files', compact('file', 'content'));
    }

    public function editFilePublic(Request $request){
        $this->checkUser($request);

        $file = $request->input('filename');
        $content = Storage::get($file);

        return view('edit-files-public', compact('file', 'content'));
    }

    public function updateFile(Request $request){
        $this->checkUser($request);

        $filename = $request->input('filename');
        $content = $request->input('content');
        $arr = explode('/', $filename);
        $arrDirectory = $arr;
        $directory = $arrDirectory[0] . '/' . $arrDirectory[1];
        $arrDirectory = explode('_', $filename);
        $arrFileName = $arrDirectory[2];
       // dd($directory,$arrFileName);

        date_default_timezone_set('Atlantic/Canary');
        $fileNameDate = date('Y-m-d_H-i-s').'_'. $arrFileName;
   

        
        Storage::put($directory . '/' . $fileNameDate, $content);
        return redirect('/text-editor');
    }

    public function updateFilePublic(Request $request){
        $this->checkUser($request);
        $userSession = session()->get('user');
        $usernameSession = $userSession->getUsername();

        $file = $request->input('filename');
        $content = $request->input('content');

        $arr = explode('/', $file);
        $arrDirectory = $arr;

        $directory = $arrDirectory[0] . '/' . $arrDirectory[1];

        $arrDirectory = explode('_', $file);

        $arrFileName = $arrDirectory[2] . '_' . $usernameSession . '.txt';
        
        date_default_timezone_set('Atlantic/Canary');
        $fileNameDate = date('Y-m-d_H-i-s').'_'. $arrFileName;

        Storage::put($directory . '/' .$fileNameDate, $content);
        return redirect('/text-editor');
    }




}
