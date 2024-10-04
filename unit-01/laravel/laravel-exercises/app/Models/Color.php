<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;


    /**
     * Color constructor.
     *
     * @param string $name
     * @param string $description
     *
     *
     * */

     public function __construct(int $id = 0, string $name = ""){
        $this->id = $id;
        $this->name = $name;
    }


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }


        /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
    public function __toString(){
        return $this->id. "-". $this->name ;
    }

}