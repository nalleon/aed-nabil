<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextEditor extends Controller
{
    public function writeText(){
        return view('text-editor');
    }
}
