<?php

namespace App\Http\Controllers;
use App\Models\Color;
use Illuminate\Http\Request;

class Practice13Controller extends Controller
{
    public function getColors() {
        $colors = session()->get('colors', []);

        if(!isset($colors)){
            $colors = [];
            session()->put('colors', $colors);
        }
      
        return view('practice13', compact('colors'));    
    }
    
    public function addColor(Request $request){
        $colors = session()->get('colors', []);

        $name = $request->input('color')??null;
        $id = count($colors) + 1;
      

        $newColor = new Color( $id, $name);
        $colors[] = $newColor;

        session()->put('colors', $colors); 

        return redirect('/practice13');
    }

    public function updateColor(Request $request){
        $colors = session()->get('colors', []);

        $id = $request->input('id');
        $name=$request->input('color');

        foreach($colors as $key => $item){
            if($item->getId() == $id){
                $item->setSubject($name);
                $colors[$key] = $item;
                break;
            }
        }

        session()->put('colors', $colors);
        return redirect('/practice13');
    }


    public function deleteColor(Request $request){
        $colors = session()->get('colors', []);
        $id = $request->input('id');

        foreach($colors as $key => $item){
            if($item->getId() == $id){
                unset($colors[$key]);
                break;
            }
        }

        session()->put('colors', array_values($colors));
        return redirect('/practice13');
    }

}
