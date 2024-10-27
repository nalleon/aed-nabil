<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBBDD extends Model{

    use HasFactory;

    protected $table = 'usuarios'; 

    protected $fillable = ['nombre', 'password', 'rol'];

    public $timestamps = false;
    
    /**
     * @var integer
     */
    private int $id;

    /**
     * @var string
     * */
    private String $name;

    /**
     * @var string
     * */
    private String $password;

    /**
     * @var string
     * */
    private String $rol;


    // getters and setters

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function setName(string $name): void{
        $this->name = $name;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getRol(): string {
        return $this->rol;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }
    
}
