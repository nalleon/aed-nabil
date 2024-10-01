<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice12Controller extends Controller
{
    function showImgs(){
        $imgArray =['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 'img5.jpg'];
    
        return view('practice12', compact('imgArray' ));
    }
}
