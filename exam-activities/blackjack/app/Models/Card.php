<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    /**
     * @var string type of card (hearts, )
     */
    private $suit;
    /**
     * @var int
     */
    private $rank;
    /**
     * @var int
     */
    private $value;


    /**
     * Constructor of the class
     */
    public function __construct(string $suit, int $rank, int $value){
        $this->suit = $suit;
        $this->rank = $rank;
        $this->value = $value;
    }

    /**
     * Getters and setters
     */


    /**
     * Get the value of value
     *
     * @return  int
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @param  int  $value
     *
     * @return  self
     */ 
    public function setValue(int $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of suit
     */
    public function getSuit() {
        return $this->suit;
    }

    /**
     * Set the value of suit
     */
    public function setSuit($suit): self {
        $this->suit = $suit;
        return $this;
    }

    /**
     * Get the value of rank
     */
    public function getRank() {
        return $this->rank;
    }

    /**
     * Set the value of rank
     */
    public function setRank($rank): self {
        $this->rank = $rank;
        return $this;
    }
}
