<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Practice20Controller extends Controller
{
    public function showFiles(){
        $files = Storage::files('practice20'); 
        return view('practice20', compact('files'));
    }


    public function downloadFile($filename){
        return Storage::download('practice20/' . $filename);
    }

    public function deleteFile($filename){
        Storage::delete('practice20/' . $filename);
        return redirect('/practice20');
    }
}
