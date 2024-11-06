<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class Practice12Controller extends Controller
{
    public function create(){
        $asignatura = new Asignatura();
        $asignatura->nombre='ETS';
        $asignatura->curso='1º DAM';
        $asignatura->save();

        Asignatura::create([
           'nombre' => 'DAD',
           'curso' => '2º DAM',
        ]);

        
        $data1ro = Asignatura::where('nombre', 'ETS')->get();   
        $data2do = Asignatura::where('nombre', 'DAD')->get();

        return view('practice12', compact('data1ro', 'data2do'));
    }


    public function modify(){
        $asignatura2do = null;
        $asignatura2do = Asignatura::find(9); 
        $asignatura2do->nombre='ETS modify';
        $asignatura2do->curso='2º DAM';


        $asignatura2do->save();

        $asignatura1ro = Asignatura::find(10); 
        $asignatura1ro->nombre='DAD modify';
        $asignatura1ro->curso='1º DAM';
        
        $asignatura1ro->save();

        $this->delete($asignatura2do);

        return view('practice13', compact('asignatura2do', 'asignatura1ro'));
    }


    public function delete($asignatura2do){
        $asignatura2do->delete();
    }
}
