<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * @var DeckCards
     */
    private $deck;
    /**
     * @var Player
     */
    private $playerGame;

    /**
     * @var Player
     */

    private $dealer;

    /**
     * @var int
     */
    private $currentTurn;

    public function __construct($playerGame){
        $this->deck = new DeckCards();
        $this->currentTurn = 0;
        $this->dealer = new Player("Dealer");
        $this->playerGame = $playerGame;
    }

    //TODO: implement logic for player/dealer turn


    public function hitPlayerAction(){
        $card = $this->deck->dealCard();
        $this->playerGame->addCard($card);
    }

    public function hitDealerAction(){
        $card = $this->deck->dealCard();
        $this->dealer->addCard($card);
    }


    public function standPlayerAction(){

    }


    public function standDealerAction(){

    }

    public function getPlayerAction($playerAction, $dealerAction){
        if($playerAction == 'hit'){
            $this->hitPlayerAction();
        } else {
            $this->standPlayerAction();
        }


        if($dealerAction == 'hit'){
            $this->hitDealerAction();
        } else {
            $this->standDealerAction();
        }


    }
}
