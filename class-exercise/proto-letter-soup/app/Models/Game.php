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
        for($i = 0; $i < $this->size; $i++){
            for ($j = 0; $j < $this->size; $j++) {
                $this->arrayLetters[$i][$j] = chr(rand(65,90));
            }
        }
        return $this->arrayLetters;
    }


    public function userInputValue($arraySelection){
        $arrayWord = implode(',', $arraySelection);
        return $arrayWord;
    }



}
