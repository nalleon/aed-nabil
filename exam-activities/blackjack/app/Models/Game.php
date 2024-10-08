<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    private $deck;
    private $players = [];
    private $dealer;
    private $currentTurn;

    public function __construct(){
        $this->deck = new DeckCards();
        $this->currentTurn = 0;
        $this->dealer = new Player("Dealer");

    }
}
