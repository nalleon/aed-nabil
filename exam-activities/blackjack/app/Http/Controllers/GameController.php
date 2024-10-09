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
        $dealer = $game->getDealer();

        if ($action === 'stand' && $dealer->getIsStand()) {
            if ($result === true){
                $message = $player->getPlayerName() . " wins!";
            } elseif ($result === false){
                $message = $dealer->getPlayerName() . " wins!";
            } else {
                $message = "";
            }
            session(['message' => $message]);
        }

        $dealer = $game->getDealer();

        session(['game' => $game]);
        session(['player' => $player]);
        session(['dealer' => $dealer]);

        return redirect('/blackjack');
    }


    public function startGame(Request $request) {
        $playerName = $request->input('playerName');
        $player = new Player();
        $player->setPlayerName($playerName);
       
        $game = new Game($player);
        $dealer = $game->getDealer();

        $game->initialDeal();
    
        session(['game' => $game]);
        session(['player' => $player]);
        session(['dealer' => $dealer]);
    
        return redirect('/blackjack');
    }
    
    
}
