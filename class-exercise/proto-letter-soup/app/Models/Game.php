<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    public $size;
    public $arrayLetters;


    public function __construct (){
        $this->size = 10;
        $this->arrayLetters = [];
    }


    public function generateLetters(){
        for($i = 0; $i < $this->size*2; $i++){
            $this->arrayLetters[$i] = chr(rand(65,90));
        }
        return $this->arrayLetters;
    }

    public function userInputValue($arraySelection){
        $arrayWord = explode(',', $arraySelection);
        return $arrayWord;
    }



}
