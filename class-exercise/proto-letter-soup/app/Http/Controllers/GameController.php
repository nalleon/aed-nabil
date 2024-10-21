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

        session(['soupLetters' => $soupLetters]);

        return view('welcome', compact('soupLetters'));
    }

    public function playgame (Request $request){
        $arrSelection = [];
        $soupLetters = session('soupLetters', []);

        $selection = $request->get('letter', []);
        //dd($selection);

        $selectionString = implode('', $selection);


        $arrSelection = $selection;

        $history = session('history', []);
        $history[] = $selectionString;

        session(['history' => $history]);
        
        $word = $this->userInputValue($selection);

        session(['word' => $word]);
        session(['selection' => $selection]);


        return view('welcome', compact('soupLetters','selection', 'word', 'history'));

    }

    public function userInputValue($arraySelection){
        if (is_array($arraySelection)) {
            return $arraySelection;
        }

        return explode(',', $arraySelection);
    }
}
