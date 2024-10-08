<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    /**
     * @var string name of the player
     */
    private $playerName;
    /**
     * @var array of cards in the player's hand
     */
    private $hand; 
    /**
     * @var int number of points of the player
     */
    private $score; 


    /**
     * Constructor of the class
     */
    public function __construct($playerName) {
        $this->playerName = $playerName;
        $this->hand = [];
        $this->score = 0;
    }


    /**
     * Add a card to the player's hand
     *
     * @param  Card  $card  the card to be added
     *
     **/

     public function addCard(Card $card) {
        $this->hand[] = $card;
        $this->score = $this->calculateScore();
    }

    /**
     * Function to calculate the score of the player
     */

    private function calculateScore() {
        $aceCounter = 0;
        $this->score = 0; 
        
        foreach ($this->hand as $card) {
            $this->score += $card->getValue();
            if ($card->getRank() == 'A') {
                $aceCounter++;
            }
        }

        while($aceCounter > 0 && $this->score > 21){
            $this->score = $this->score - 10;
            $aceCounter--;
        }
    }

    /**
     * Function to check if player has lost
     */
    private function isGameOver(){
        return $this->score > 21;
    }


    /**
     * Getters and setters
     */

    /**
     * Get the value of playerName
     */
    public function getPlayerName() {
        return $this->playerName;
    }

    /**
     * Set the value of playerName
     */
    public function setPlayerName($playerName): self {
        $this->playerName = $playerName;
        return $this;
    }

    /**
     * Get of cards in the player's hand
     *
     * @return  array
     */ 
    public function getHand()
    {
        return $this->hand;
    }

    /**
     * Set of cards in the player's hand
     *
     * @param  array  $hand  of cards in the player's hand
     *
     * @return  self
     */ 
    public function setHand(array $hand)
    {
        $this->hand = $hand;

        return $this;
    }

    /**
     * Get number of points of the player
     *
     * @return  int
     */ 
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set number of points of the player
     *
     * @param  int  $score  number of points of the player
     *
     * @return  self
     */ 
    public function setScore(int $score)
    {
        $this->score = $score;

        return $this;
    }
}
