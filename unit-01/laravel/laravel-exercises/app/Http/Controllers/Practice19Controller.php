<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class Practice19Controller extends Controller
{
    public function showFiles(){
        $files = Storage::files('practice19'); 
        return view('practice19', compact('files'));
    }


    public function downloadFile($filename){
        return Storage::download('practice19/' . $filename);
    }

}
