<?php

namespace App\Models;
/**
 * @author Nabil L. A.
 */
class UserBBDD {

    
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

    /**
     * @var integer
     */
    private int $deleted;


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
    
    public function getDeleted(): int {
        return $this->deleted;
    }

    public function setDeleted(int $deleted): void {
        $this->deleted = $deleted;
    }
}
