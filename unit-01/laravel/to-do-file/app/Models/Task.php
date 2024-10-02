<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $finished;

    /**
     * Task constructor.
     *
     * @param string $subject
     * @param string $description
     *
     *
     * */

     public function __construct(string $subject = "", int $id = 0, string $description = "", bool $finished = false){
        $this->subject = $subject;
        $this->id = $id;
        $this->description = $description;
        $this->finished = $finished;
    }


    /**
     * Get the value of subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     */
    public function setSubject($subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of finished
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set the value of finished
     */
    public function setFinished($finished): self
    {
        $this->finished = $finished;

        return $this;
    }

    public function __toString(){
        return $this->subject . " - " . $this->description . " - " . ($this->finished? "Finished" : "Not finished");
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
}
