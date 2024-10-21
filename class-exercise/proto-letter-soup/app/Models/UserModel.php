<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @author Nabil L. A. (nalleon)
 */
class UserModel
{
    //use HasFactory;

    /**
     * @var int id of the user
     */
    public $id;

    /**
     * @var string name of the user
     */
    public $username;

    /**
     * Constructor of the UserModel
     */

    public function __construct (int $id=0, string $username=""){
        $this->id=$id;
        $this->username=$username;
    }

    /**
     * Getters and setters
     */

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