<?php

namespace App\Models;

use App\Https\Models\UserModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $id;

    public $user;

    public $message;



    public function __constructor(int $id=0, UserModel $user= new UserModel(), string $message=""){
        $this->id=$id;
        $this->user=$user;
        $this->message=$message;

    }

    public function getId(){
        return $this->id;
    }

    public function getUser(){
        return $this->user;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }


    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setMessage($message): self{
        $this->message = $message;
        return $this;
    }

}
