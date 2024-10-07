<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Practice17Controller extends Controller
{
    public function createDirectory(Request $request){
        $directory = $request->input('directory');
        if($directory ==! null){
            Storage::makeDirectory('/' . $directory, 700, true);
            echo "Directory created successfully";
        }
        return view('/practice17');
    }

}
