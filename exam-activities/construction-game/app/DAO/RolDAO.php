<?php

namespace App\DAO;

use App\Contracts\FiguraContract;
use App\Contracts\RolContract;
use App\Models\Figura;
use App\Models\Rol;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;




class RolDAO implements ICrud
{


    public function __construct() {}



    public function delete($id): bool
    {

        $myPDO = DB::getPdo();
        $tablename = RolContract::TABLE_NAME;
        $colid = RolContract::COL_ID;
        $sql = "DELETE FROM $tablename WHERE $colid  = :id";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':id' => $id]);
        $filasAfectadas = $stmt->rowCount();
        return $filasAfectadas > 0;
    }


    public function update($p): bool
    {

        $colid = RolContract::COL_ID;
        $colnombre = RolContract::COL_NOMBRE;
        $tablename = RolContract::TABLE_NAME;
        $myPDO = DB::getPdo();
        if (!($p->getId() > 0)) {
            return false;
        }
        $sql = "UPDATE $tablename ".
               " SET $colnombre = :nombre " .
               " WHERE $colid = :id";


        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nombre' => $p->getNombre(),
                    ':id' => $p->getId()

                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();



            if ($filasAfectadas > 0) {

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


    public function findById($id): object | null
    {

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
                ->setNombre($row[RolContract::COL_NOMBRE]);
            return $p;
        }

        return null;
    }


    public function findAll(): array
    {

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
                ->setNombre($row[RolContract::COL_NOMBRE]);
            $roles[] = $p;
        }

        return $roles;
    }

    public function save($p): object | null
    {
        $myPDO = DB::getPdo();
        $tablename = RolContract::TABLE_NAME;
        $colid = RolContract::COL_ID;
        $colnombre = RolContract::COL_NOMBRE;

        $sql =
        "INSERT INTO $tablename ( $colnombre)
         VALUES(:nombre)";

        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nombre' => $p->getNombre()

                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();



            //forzamos un rollback aleatorio para ver que deshace los cambios
            if ($filasAfectadas > 0) {
                //obtenemos el id generado con:
                $idgenerado = $myPDO->lastInsertId();
                $p->setId($idgenerado);
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
