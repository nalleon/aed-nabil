<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Moneda;


class Practice16Controller extends Controller{
    public function createHistoric(){
        $dolar = Moneda::find(1);    
        $newDate = date('Y-m-d', strtotime('+2 days'));


        $historicDolar1 = Historico::where('id', 1)->take(1)
        ->first();

        $newValue = $historicDolar1->equivalenteeuro;
        $newValue -= 0.02;
        


        $newHistoric = new Historico();
        $newHistoric->fecha = $newDate;
        $newHistoric->equivalenteeuro = $newValue;

        $dolar->historicos()->save($newHistoric);


        $historic = Historico::where('id', 4)->get();

        return view('Practice16', compact('historic'));
    }
}
