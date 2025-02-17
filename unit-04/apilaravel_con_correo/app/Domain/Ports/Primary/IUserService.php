<?php

namespace App\Domain\Ports\Primary;


interface IUserService {

    public function getById(String $id);


    public function getAll();

}
