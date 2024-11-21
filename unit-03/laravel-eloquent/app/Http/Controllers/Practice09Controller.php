<?php

namespace App\Http\Controllers;

use App\Models\Matricula;

class Practice09Controller extends Controller{
    public function findByDate(){
        $data = Matricula::where('year', 2021)->get();
        return view('Practice09', compact('data'));
    }   


    public function find(){
        $dataGet = Matricula::where('year', 2021)
                    ->orderBy('year','desc')
                    ->take(1)
                    ->get();

        $dataFirst = Matricula::where('year', 2021)
                    ->orderBy('year','desc')
                    ->take(1)
                    ->first();

        dd($dataGet, $dataFirst);
    }
}
