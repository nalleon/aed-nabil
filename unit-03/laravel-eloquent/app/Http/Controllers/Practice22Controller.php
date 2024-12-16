<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Practice22Controller extends Controller
{
    public function showAlumnos() {
        $alumnos = Alumno::all();
        return view('Practice22', compact('alumnos'));
    }
}
