<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Card;
use App\Models\Player;

class Game //extends Model
{
    //use HasFactory;

    /**
     * @var DeckCards
     */
    public $deck;
    /**
     * @var Player
     */
    public $playerGame;

    /**
     * @var Player
     */

     public $dealer;

    const BLACKJACK = 21;
    const DEALER_STAND = 17;
    const HIT = 'hit';
    const STAND = 'stand';


    public function __construct($playerGame){
        $this->deck = new DeckCards();
        $this->dealer = new Player("Dealer");
        $this->playerGame = $playerGame;
    }

    public function initialDeal() {
        for ($i = 0; $i < 2; $i++) {
            $this->playerGame->addCard($this->deck->drawCard());
            $this->dealer->addCard($this->deck->drawCard());
        }
    }


    public function getActions($playerAction){
        if($playerAction == self::HIT){
            $card = $this->deck->drawCard();
            $this->playerGame->addCard($card);

            if($this->playerGame->getScore() > self::BLACKJACK){
                return $this->checkGameOver();
            }

        } elseif($playerAction == self::STAND){
            $this->playerGame->setIsStand(true);
        }

        $dealerAction = $this->dealerActions();

        if($dealerAction == self::HIT){
            $card = $this->deck->drawCard();
            $this->dealer->addCard($card);

        } elseif($dealerAction == self::STAND){
            $this->dealer->setIsStand(true);
            //dd($dealerAction);
        }

        if ($this->playerGame->getIsStand() && $this->dealer->getIsStand()) {
            return $this->checkGameOver();
        }
    }


    public function dealerActions(){
        $score = $this->dealer->getScore();

        if($score < 11){
            return self::HIT;
        }

        if($score >= 11 && $score <= self::DEALER_STAND){
            $probability = rand(1, 100);
            if($probability >= 70){
                return self::HIT;
            } else {
                return self::STAND;
            }
        }

        if($score == self::BLACKJACK){
            return self::STAND;
        }

        return self::STAND;
    }



    public function checkGameOver() {
        $playerScore = $this->playerGame->getScore();
        $dealerScore = $this->dealer->getScore();
        if ($playerScore > self::BLACKJACK) {
            $this->endGame();
            return false;
        }

        if ($dealerScore > self::BLACKJACK) {
            $this->endGame();
            return true;
        }

        if ($playerScore > $dealerScore) {
            $this->endGame();
            return true;
        } else {
            $this->endGame();
            return false;
        }
    }



    public function endGame(){
        $this->playerGame->setIsStand(false);
        $this->dealer->setIsStand(false);

        $this->deck = new DeckCards();
    }
    /**
     * Get the value of playerGame
     *
     * @return  Player
     */
    public function getPlayerGame()
    {
        return $this->playerGame;
    }

    /**
     * Set the value of playerGame
     *
     * @param  Player  $playerGame
     *
     * @return  self
     */
    public function setPlayerGame(Player $playerGame)
    {
        $this->playerGame = $playerGame;

        return $this;
    }

    /**
     * Get the value of deck
     *
     * @return  DeckCards
     */
    public function getDeck()
    {
        return $this->deck;
    }

    /**
     * Set the value of deck
     *
     * @param  DeckCards  $deck
     *
     * @return  self
     */
    public function setDeck(DeckCards $deck)
    {
        $this->deck = $deck;

        return $this;
    }

    /**
     * Get the value of dealer
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Set the value of dealer
     *
     * @return  self
     */
    public function setDealer($dealer)
    {
        $this->dealer = $dealer;

        return $this;
    }
}
