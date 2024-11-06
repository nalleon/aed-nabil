<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;

class Practice16Controller extends Controller
{
    public function createHistoric(){
        $historicoNuevo = new Historico();
        $historicoNuevo->fecha = '2021-12-31';
        $historicoNuevo->equivalenteeuro = 0.89;
        
        //$dolar1->historicos()->save($historicoNuevo);
    }
}
