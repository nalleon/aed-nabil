<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{

    /**
     * Method to check if the session has an user
     */
    public function checkUser(){
        if(!session()->has('user')){
            return redirect()->route('login')->send();
        }
    }


    public function index() {       
        $this->checkUser();

        $directory = session()->get('username');
        Storage::makeDirectory($directory, 700, true);

        $files = Storage::files($directory);
        return view('home', compact('files'));
    }

    public function createBoard() {
        $directory = session()->get('username');
        Storage::makeDirectory($directory, 700, true);
        //Storage::put($directory ."/". $filenameToCreate, $content);
    }

    public function editBoard($id) {
        
    }


}
