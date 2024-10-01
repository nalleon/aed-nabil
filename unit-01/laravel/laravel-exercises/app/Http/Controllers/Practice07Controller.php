<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice07Controller extends Controller
{
    public function primeNums()
    {
    $primeArray = collect([1,2,3,5,7,11,13,17,19]);
    return view('practice07',compact('primeArray'));
    }
}
