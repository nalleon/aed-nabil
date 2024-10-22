<?php
namespace App\DAO;

use App\DAO\ICrud;
use Illuminate\Support\Facades\DB;

use PDO;

class Rol {
    private String $name;
    private int $id;

    public function __construct($name = "", $id = 0){

    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }


}

class RolDAO implements ICrud{
    public function __construct() {}


    public function findAll()
    {
        $myPDO = DB::getPdo();
        // FETCH_ASSOC
        $stmt = $myPDO->prepare("SELECT * FROM  roles");
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $roles = [];
        while ($row = $stmt->fetch()) {
            $p = new Rol();
            $p->setId($row["id"])
                ->setName($row["nombre"]);
            $roles[] = $p;
        }
        return $roles;
    }

    public function save($dao){}

    public function findById($id) {}
    public function update($dao){}
    public function delete($id){}
}
