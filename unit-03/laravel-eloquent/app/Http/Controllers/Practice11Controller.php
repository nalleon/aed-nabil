<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class Practice11Controller extends Controller {
    public function find1DAM(){
        $data = Asignatura::where('curso', '1º DAM')->get();   
        return view('Practice11', compact('data'));
    }
}
