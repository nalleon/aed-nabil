<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class Practice18Controller extends Controller
{
    public function index(){
        $asignaturas = Asignatura::with('matriculas')->get();

        foreach ($asignaturas as $asignatura) {
            echo "Asignatura: " . $asignatura->nombre . "\n";
            foreach ($asignatura->matriculas as $matricula) {
                echo "- Nombre: " . $matricula->nombre . ", DNI: " . $matricula->dni . "\n";
            }
        }
        
    }
}
