<?php
namespace App\DAO;

use App\Contracts\UserBBDDContract;
//use App\Contracts\TableroContract;
use App\Models\UserBBDD;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;

class UserBBDDDAO implements ICrud {

    public function __construct() {}

    public function delete($id): bool{

        $myPDO = DB::getPdo();
        $tablename = UserBBDDContract::TABLE_NAME;
        $colid = UserBBDDContract::COL_ID;

        $sql = "DELETE FROM $tablename WHERE $colid = :id";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':id' => $id]);
        $affectedRows = $stmt->rowCount();

        return $affectedRows > 0;
    }


    public function update($p): bool{

        $colid = UserBBDDContract::COL_ID;
        $colname = UserBBDDContract::COL_NAME;
        $colpassword = UserBBDDContract::COL_PASSWORD;
        $colrol = UserBBDDContract::COL_ROL;

        $tablename = UserBBDDContract::TABLE_NAME;
        $myPDO = DB::getPdo();
       
       // dd($p->getId());

       


        $sql = "UPDATE $tablename ".
               " SET $colname = :nombre, " .
               " $colpassword = :password, " .
               " $colrol = :rol " .
               " WHERE $colid = :id";

               
        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
           
            $stmt->execute(
                [
                    ':nombre' => $p->getName(),
                    ':id' => $p->getId(),
                    ':password' => $p->getPassword(),
                    ':rol' => $p->getRol()

                ]
            );
            //si affectedRows > 0 => hubo éxito consulta
            $affectedRows = $stmt->rowCount();


            if ($affectedRows > 0) {
                
                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return false;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback";
            var_dump($ex);
            $myPDO->rollBack();
            return false;
        }
        $stmt = null;
        return true;
    }


    public function findById($id): object | null {

        $tablename = UserBBDDContract::TABLE_NAME;
        $colid = UserBBDDContract::COL_ID;

        $sql = "SELECT * FROM $tablename WHERE $colid = :id";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new UserBBDD();

            $p->setId($row[UserBBDDContract::COL_ID]);
            $p->setName($row[UserBBDDContract::COL_NAME]);
            $p->setPassword($row[UserBBDDContract::COL_PASSWORD]);
            $p->setRol($row[UserBBDDContract::COL_ROL]);

            return $p;
        }

        return null;
    }


    public function findAll(): array{
        $tablename = UserBBDDContract::TABLE_NAME;

        $sql = "SELECT * FROM $tablename";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $UserBBDDs = [];
        while ($row = $stmt->fetch()) {
            $p = new UserBBDD();
            $p->setId($row[UserBBDDContract::COL_ID]);
            $p->setName($row[UserBBDDContract::COL_NAME]);
            $p->setPassword($row[UserBBDDContract::COL_PASSWORD]);
            $p->setRol($row[UserBBDDContract::COL_ROL]);

            $UserBBDDs[] = $p;
        }

        return $UserBBDDs;
    }

    public function save($p): object | null{
        $myPDO = DB::getPdo();
        $tablename = UserBBDDContract::TABLE_NAME;
        $colname = UserBBDDContract::COL_NAME;
        $colpassword = UserBBDDContract::COL_PASSWORD;
        $colrol = UserBBDDContract::COL_ROL;

        $roleName = $p->getRol(); 
        $roleDAO = new RolDAO();

        $allRoles = $roleDAO->findAll();

        $rolId = 0;
        foreach ($allRoles as $role) {
            if ($role->getName() === $roleName) {
                $rolId = $role->getId();
                break;
            }
        }

        $sql =
        "INSERT INTO $tablename ( $colname, $colpassword, $colrol)
         VALUES(:nombre, :passwd, :rol)";

        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nombre' => $p->getName(),
                    ':passwd' => $p->getPassword(),
                    ':rol' => $rolId
                ]
            );

            //si affectedRows > 0 => hubo éxito consulta
            $affectedRows = $stmt->rowCount();

            //forzamos un rollback aleatorio para ver que deshace los cambios
            if ($affectedRows > 0) {
                //obtenemos el id generado con:
                $idgenerado = $myPDO->lastInsertId();
                $p->setId($idgenerado);
                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return null;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback";
            var_dump($ex);
            $myPDO->rollBack();
            return null;
        }
        $stmt = null;

        return $p;
    }





}
