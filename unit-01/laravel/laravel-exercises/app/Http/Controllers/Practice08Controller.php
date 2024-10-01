<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice08Controller extends Controller
{
    public function date() {
        $currentDateTime = date('H:i \d\e l, d-m-Y');
        return view('practice08', compact('currentDateTime'));
    }
}
