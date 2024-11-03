<?php

namespace App\Repository;

use App\DAO\UserBBDDDAO;
use App\DAO\UserFileDAO;
use App\Repository\Interface\IRepositoryCrud;

class UserRepository implements IRepositoryCrud {

    protected $userBBDDDAO;
    protected $userFileDAO;

   // protected const FILE_PATH =  "storage/app/users.dat";

    public function __construct(){
        $this->userBBDDDAO = new UserBBDDDAO();
        $this->userFileDAO = new UserFileDAO();
    }

    public function findAll(): array{
        $users = [];
        try {
            $users = $this->userBBDDDAO->findAll();
        } catch (\Exception $e) {
            $users = $this->userFileDAO->findAll();
        } 

        return $users;
    }
    public function save($p): object | null{
        $userAdded = null;
        try {
            $userAdded = $this->userBBDDDAO->save($p);
            $this->userFileDAO->save($p);
        } catch (\Exception $e) {
            $userAdded = $this->userFileDAO->save($p);
        }

        return $userAdded;
    }

    public function findById($id): object | null {
        $userFind = null;
        try {
            $userFind = $this->userBBDDDAO->findById($id);
        } catch (\Exception $e) {
            $userFind = $this->userFileDAO->findById($id);
        }

        return $userFind;
    }

    public function findByName($name): object | null {
        $userFind = null;
        try {
            $userFind = $this->userBBDDDAO->findByUsername($name);
        } catch (\Exception $e) {
            $userFind = $this->userFileDAO->findByUsername($name);
        }

        return $userFind;
    }

    public function update($p): bool {   
        $userUpdate = false;
        try {
            $userUpdate = $this->userBBDDDAO->update($p);
            $this->userFileDAO->update($p);
        } catch (\Exception $e) {
            $userUpdate = $this->userFileDAO->update($p);
        }

        return $userUpdate;
    }
    public function delete($id): bool{
        $userDeleted = false;

        try {
            $userDeleted = $this->userBBDDDAO->delete($id);
        } catch (\Exception $e) {
            $userDeleted = $this->userFileDAO->delete($id);
        }

        return $userDeleted;
    }
}
