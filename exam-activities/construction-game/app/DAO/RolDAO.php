<?php

namespace App\DAO;

use App\Contracts\RolContract;
use App\Models\Rol;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;

/**
 * @author Nabil L. A.
 */

class RolDAO implements ICrud{

    /**
     * Default constructor
     */
    public function __construct() {}

    /**
     * Function to delete a role
     */
    public function delete($id): bool{
        $myPDO = DB::getPdo();
        $tablename = RolContract::TABLE_NAME;
        $colid = RolContract::COL_ID;


        $sql = "DELETE FROM $tablename WHERE $colid  = :id";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':id' => $id]);
        $affectedRows = $stmt->rowCount();
        return $affectedRows > 0;
    }

    /**
     * Function to update a role
     */
    public function update($p): bool{

        $colid = RolContract::COL_ID;
        $colnombre = RolContract::COL_NAME;
        $tablename = RolContract::TABLE_NAME;
        $myPDO = DB::getPdo();
        if (!($p->getId() > 0)) {
            return false;
        }
        $sql = "UPDATE $tablename ".
               " SET $colnombre = :nameRole " .
               " WHERE $colid = :id";


        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nameRole' => $p->getName(),
                    ':id' => $p->getId()

                ]
            );
            $affectedRows = $stmt->rowCount();
            if ($affectedRows > 0) {

                $myPDO->commit();
            } else {
                $myPDO->rollback();
                return false;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback";
            var_dump($ex);
            $myPDO->rollback();
            return false;
        }
        $stmt = null;
        return true;
    }

    /**
     * Function to find by id a role
     */
    public function findById($id): object | null{

        $tablename = RolContract::TABLE_NAME;
        $colid = RolContract::COL_ID;

        $sql = "SELECT * FROM $tablename WHERE $colid = :id";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new Rol();
            $p->setId($row[RolContract::COL_ID])
                ->setName($row[RolContract::COL_NAME]);
            return $p;
        }

        return null;
    }

    /**
     * Function to find all roles
     */
    public function findAll(): array{

        $tablename = RolContract::TABLE_NAME;

        $sql = "SELECT * FROM $tablename";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $roles = [];
        while ($row = $stmt->fetch()) {
            $p = new Rol();
            $p->setId($row[RolContract::COL_ID])
                ->setName($row[RolContract::COL_NAME]);
            $roles[] = $p;
        }

        return $roles;
    }

    /**
     * Function to add a role
     */
    public function save($p): object | null {
        $myPDO = DB::getPdo();
        $tablename = RolContract::TABLE_NAME;
        $colnombre = RolContract::COL_NAME;

        $sql =
        "INSERT INTO $tablename ( $colnombre)
         VALUES(:nameRole)";

        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nameRole' => $p->getName()

                ]
            );

            $affectedRows = $stmt->rowCount();

            if ($affectedRows > 0) {
                $idGenerated = $myPDO->lastInsertId();
                $p->setId($idGenerated);
                $myPDO->commit();
            } else {
                $myPDO->rollback();
                return null;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback";
            var_dump($ex);
            $myPDO->rollback();
            return null;
        }
        $stmt = null;

        return $p;
    }
}
