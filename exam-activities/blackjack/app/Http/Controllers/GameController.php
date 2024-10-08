<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;

class GameController extends Controller
{

    private $game;

    // route /player-action
    public function getActions(Request $request){
        $playerName = $request->input('playerName');
        $handJson = $request->input('hand');
        $hand = json_decode($handJson, true);
        $score = $request->input('score');
        $player = new Player();

        $player->setPlayerName($playerName);
        $player->setHand($hand);
        $player->setScore($score);

        $game = new Game($player);
        
        $action = $request->input('action');

        return redirect('/blackjack');
    }
}
