<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeckCards;
use App\Models\Card;
use App\Models\Player;

class Game //extends Model
{
    //use HasFactory;

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

    const BLACKJACK = 21;
    const DEALER_STAND = 17;

    public function __construct($playerGame){
        $this->deck = new DeckCards();
        $this->dealer = new Player("Dealer");
        $this->playerGame = $playerGame;
    }


    public function getActions($playerAction, $dealerAction){
        $counterStand = 0;

        if($playerAction == 'hit'){
            $this->hitPlayerAction();
        } else {
            $counterStand++;
            $this->playerGame->setIsStand(true);
        }

        if($dealerAction == 'hit' && $this->dealer->getScore() < self::DEALER_STAND){
            $this->hitDealerAction();
        } else {
            $counterStand++;
            $this->dealer->setIsStand(true);
        }

        if($counterStand == 2){
            $this->checkGameOver();
        }
    }


    public function hitPlayerAction(){
        $card = $this->deck->drawCard();
        $this->playerGame->addCard($card);
    }

    public function hitDealerAction(){
        $card = $this->deck->drawCard();
        $this->dealer->addCard($card);
    }


    public function checkGameOver(){
        $playerScore = $this->playerGame->getScore();
        $dealerScore = $this->dealer->getScore();

        if($playerScore <= self::BLACKJACK && $dealerScore <= self::BLACKJACK){
            if($playerScore > $dealerScore){
                return true;
            }
        }
        return false;
    }
}
