<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerRndNum extends Controller{

    public function processForm(Request $request){
        echo "llegado a processForm";
        //die();
        $quantityRnd = $request->input('quantityRnd')??null;
        $startNumRange = $request->input('startNumRange')??null;
        $finishNumRange = $request->input('finishNumRange')??null;

        return view('viewResult', ['quantityRnd' =>$quantityRnd,
                                    'startNumRange' => $startNumRange,
                                    'finishNumRange' => $finishNumRange]);
    }

    //logic
    function generateRandomNumbers(
        $quantityRnd, $startNumRange, $finishNumRange){

        $array = [];
        $counter = 0;

        for ($i=$startNumRange; $i<$finishNumRange; $i++) {
            $array[] = rand(1,100);
        }
        
        return view('rndnum', compact('array'));
    }
}
