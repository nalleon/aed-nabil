<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller; unnecessary

class ControllerTest extends Controller{
    public function greetings(){
        $array = [];
        for ($i=0; $i<10; $i++) {
            $array = rand(1,100);
        }
        return view('rndnum', compact('array'));
        // ['array' => $array ] key//value
    }
}


