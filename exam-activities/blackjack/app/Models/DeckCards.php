<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeckCards extends Model
{
    use HasFactory;

    private $deckCards = [];

    public function __construct(){
        $this->deckCards = $this->initializeDeck();
        $this->deckCards = $this->shuffleDeck();
    }

    /**
     * Function to create the deck cards
     */
    private function initializeDeck() {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $ranks = [
            '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, 
            'J' => 10, 'Q' => 10, 'K' => 10, 'A' => 11 
        ];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank => $value) {
                $this->cards[] = new Card($suit, $rank, $value);
            }
        }
    }

    private function shuffleDeck(){
        shuffle($this->deckCards);
    }

    /**
     * Getters and setters
     */

    /**
     * Get the value of deckCards
     */ 
    public function getDeckCards()
    {
        return $this->deckCards;
    }

    /**
     * Set the value of deckCards
     *
     * @return  self
     */ 
    public function setDeckCards($deckCards)
    {
        $this->deckCards = $deckCards;

        return $this;
    }
}
