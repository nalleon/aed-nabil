<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeckCards  //extends Model
{
    //use HasFactory;

    /**
     * @var array
     */
    private $deckCards = [];

    public function __construct(){
        $this->deckCards = $this->initializeDeck();
        $this->deckCards = $this->shuffleDeck();
    }

    /**
     * Function to create the deck cards
     */
    public function initializeDeck() {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $ranks = [
            '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
            'J' => 10, 'Q' => 10, 'K' => 10, 'A' => 11
        ];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank => $value) {
                $this->deckCards[] = new Card($suit, $rank, $value);
            }
        }
    }

    /**
     * Function to shuffle the deck
     */
    public function shuffleDeck(){
        shuffle($this->deckCards);
    }


    /**
     * Function to select a card from the deck
     */
    public function selectCard(){
        return $this->deckCards[0];
    }

    /**
     * Function to draw a card from the deck and remove it from it
     */

    //TODO: refactor without unshift

    public function drawCard(){
        $cardSelected = $this->selectCard();
        array_shift($this->deckCards);
        return $cardSelected;
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
