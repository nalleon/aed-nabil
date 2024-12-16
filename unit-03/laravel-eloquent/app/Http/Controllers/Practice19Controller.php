<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Moneda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Practice19Controller extends Controller
{
    public function index(){
        return view('Practice19');
    }
    public function createMoneda(Request $request){
        DB::transaction(function () use ($request) : void{
            $moneda = new Moneda();
            $moneda->pais = $request->get('pais');
            $moneda->nombre = $request->get('nombre');
            $moneda->save();

            $newHistoric = new Historico();
            $newHistoric->moneda()->associate($moneda);
            $newHistoric->fecha = $request->get('fecha');
            $newHistoric->equivalenteeuro = $request->get('equivalenteeuro');
            $newHistoric->save();

            if(!is_numeric($request->get('equivalenteeuro'))){
                DB::rollBack();
            }
        });
    }
}
