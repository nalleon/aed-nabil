<?php

namespace App\Http\Controllers;
use App\Domain\Ports\Primary\IUserService;

use Illuminate\Http\Request;

class UserService implements IUserService {

    public function getById(String $id){
        return "prueba getbyid" . $id;
    }


    public function getAll(){
        return "prueba getAll";
    }
}
