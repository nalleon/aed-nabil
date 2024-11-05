<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class Practice08Controller extends Controller {
    public function findAll(){
        $students = Alumno::all();
        return view('Practice08', compact('students'));
    }
}
