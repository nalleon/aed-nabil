<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Practice21Controller extends Controller
{
    public function matriculas(){
        $nombre = 'Ana';
        $matriculas = Matricula::whereHas(
            'alumno',
            function ($query) use ($nombre) {
                $query->where('nombre', $nombre)->where('year', '>', '2020');
            }
        );
        
        dd($matriculas->get());
    }

    public function createAlumno() {
        DB::table('alumnos')->insert([
            'dni' => '35792468Q',
            'nombre' => 'Elvira',
            'apellidos' => 'Lindo',
            'fechanacimiento' => '821234400000'
        ]);

        DB::table('matriculas')->insert([
            'dni' => '35792468Q',
            'year' => '2024'
        ]);

        $matricula = DB::table('matriculas')->where('dni', '35792468Q')->first();

        DB::table('asignatura_matricula')->insert([
            'idasignatura' => 3,
            'idmatricula' => $matricula->id
        ]);

        DB::table('asignatura_matricula')->insert([
            'idasignatura' => 7,
            'idmatricula' => $matricula->id
        ]);
    }
}
