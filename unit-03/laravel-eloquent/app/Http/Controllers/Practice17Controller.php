<?php

namespace App\Http\Controllers;

use App\Models\Moneda;
use Illuminate\Http\Request;

class Practice17Controller extends Controller
{
    public function createCurrency(){
        $currency = Moneda::create([
            'pais' => 'australia',
            'nombre' => 'Dolar'
        ]);
    

        return view('Practice17', compact('currency'));
    }

    
    public function updateCurrency(){
        $currency = Moneda::where('pais', 'australia')->first();

        $currency->pais = 'Australia';
        $currency->save();
    
        return view('Practice17', compact('currency'));
    }
}
