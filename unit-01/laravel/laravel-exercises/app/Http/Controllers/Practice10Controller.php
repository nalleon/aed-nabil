<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice10Controller extends Controller
{
    public function rndNum() {
        $array = [];
        for ($i = 0; $i < 15; $i++) {
            $array[] = rand(1, 100);
        }
        return view('practice10', compact('array'));
    }
}
