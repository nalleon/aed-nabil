<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;


    public function __construct (int $id=0, string $username=""){
        $this->id=$id;
        $this->username=$username;
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }


    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }
}