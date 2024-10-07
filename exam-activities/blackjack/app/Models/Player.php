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
    private $hand = []; 
    /**
     * @var int number of points of the player
     */
    private $score; 


    /**
     * Constructor of the class
     */
    public function __construct($playerName) {
        $this->playerName = $playerName;
        $this->score = 0;
    }

    
}
