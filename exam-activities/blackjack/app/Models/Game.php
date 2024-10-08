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
     * @var array Player
     */
    private $players = [];
    
    /**
     * @var Player
     */

    private $dealer;

    /**
     * @var int
     */
    private $currentTurn;

    public function __construct(){
        $this->deck = new DeckCards();
        $this->currentTurn = 0;
        $this->dealer = new Player("Dealer");

        foreach ($this->players as $playername){
            $this->players[] = new Player($playername);
        }
    }

    //TODO: implement logic for player/dealer turn

    public function playerTurn(){
        
    }
}
