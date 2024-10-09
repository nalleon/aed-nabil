<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use App\Models\Card;
use App\Models\DeckCard;


class GameController extends Controller
{

    public  $game;

    // route /player-action
    public function getActions(Request $request){
       $game = session('game');

        if (!$game) {
            $player = new Player();
            $playerName = $request->input('playerName');
            $player->setPlayerName($playerName);
            $game = new Game($player);
            session(['game' => $game]);
        } else {
            $player = $game->getPlayerGame();
        }
        
        $action = $request->input('action');

        $result = $game->getActions($action);
        

        if ($action === 'stand'){
            if ($result === true){
                session(['message' => 'Player wins!']);
            } elseif ($result === false){
                session(['message' => 'Dealer wins!']);
            } 
        } else {
            session(['message' => 'Game on going...']);
        }

        $dealer = $game->getDealer();

        session(['game' => $game]);
        session(['player' => $player]);
        session(['dealer' => $dealer]);

        return redirect('/blackjack');
    }

    
}
