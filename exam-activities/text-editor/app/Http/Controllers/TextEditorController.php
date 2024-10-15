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
        if(!isset($request->user) || $request->user('username') == 'public'){
            return redirect('/');
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
            $directory = "files";
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


    }


}
