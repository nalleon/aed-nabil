<?php

namespace App\Repository;

use App\DAO\UserBBDDDAO;
use App\File\UserFileCrud;
use App\Repository\Interface\IRepositoryCrud;

class UserRepository implements IRepositoryCrud {

    protected $userBBDDDAO;
    protected $userFileCrud;

    public function __construct(){
        $this->userBBDDDAO = new UserBBDDDAO();
        $this->userFileCrud = new UserFileCrud();
    }

    public function findAll(): array{
        $users = [];
        try {
            $users = $this->userBBDDDAO->findAll();
        } catch (\Exception $e) {
            $users = $this->userFileCrud->findAll();
        } 

        return $users;
    }
    public function save($p): object | null{
        $userAdded = null;
        try {
            $userAdded = $this->userBBDDDAO->save($p);
            $this->userFileCrud->save($p);
        } catch (\Exception $e) {
            $userAdded = $this->userFileCrud->save($p);
        }

        return $userAdded;
    }

    public function findById($id): object | null {
        $userFind = null;
        try {
            $userFind = $this->userBBDDDAO->findById($id);
        } catch (\Exception $e) {
            $userFind = $this->userFileCrud->findById($id);
        }

        return $userFind;
    }

    public function findByName($name): object | null {
        $userFind = null;
        try {
            $userFind = $this->userBBDDDAO->findByUsername($name);
        } catch (\Exception $e) {
            $userFind = $this->userFileCrud->findByUsername($name);
        }

        return $userFind;
    }

    public function update($p): bool {   
        $userUpdate = false;
        try {
            $userUpdate = $this->userBBDDDAO->update($p);
            $this->userFileCrud->update($p);
        } catch (\Exception $e) {
            $userUpdate = $this->userFileCrud->update($p);
        }

        return $userUpdate;
    }
    public function delete($id): bool{
        $userDeleted = false;

        try {
            $userDeleted = $this->userBBDDDAO->delete($id);
        } catch (\Exception $e) {
            $userDeleted = $this->userFileCrud->delete($id);
        }

        return $userDeleted;
    }
}
