<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Moneda;
use Illuminate\Http\Request;

class Practice15Controller extends Controller
{
    public function createHistoric15(){
        $moneda = Moneda::find(1);

        $newHistoric = new Historico();
        $newHistoric->fecha = '2024-11-07';
        $newHistoric->equivalenteeuro = 0.92;
        $newHistoric->moneda()->associate($moneda);

        $newHistoric->save();

        $historic = Historico::where('id', 5)->get();

        return view('Practice15', compact('historic'));
    }
}
