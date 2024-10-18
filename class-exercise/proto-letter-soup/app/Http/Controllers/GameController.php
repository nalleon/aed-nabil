<?php

namespace App\Http\Controllers;
use App\Models\Game;

use Illuminate\Http\Request;

class GameController extends Controller
{

    public $game;

    public function showMatrix(){
        $game = new Game();

        $soupLetters = $game->generateLetters();

        return view('welcome', compact('soupLetters'));
    }

    public function playgame (Request $request){
        $arrSelection = [];
        $selection = $request->get('letter');
        dd($selection);

        $arrSelection = array_push($selection);

        return view('welcome', compact('arrSelection'));

    }
}
