<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Moneda;
use Illuminate\Http\Request;

class Practice14Controller extends Controller
{
    public function createHistoric(){
        $moneda = new Moneda();
        $moneda->pais = "Estados Unidos";
        $moneda->nombre = "Dolar";
        $moneda->save();

        $newHistoric = new Historico();
        $newHistoric->moneda_id = 1;
        $newHistoric->fecha = '2024-11-06';
        $newHistoric->equivalenteeuro = 0.92;
        $newHistoric->save();

        $historic = Historico::where('moneda_id', 1)->get();
        return view('Practice14', compact('historic'));
    }
}
