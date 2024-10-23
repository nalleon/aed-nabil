<?php
namespace App\DAO;

use App\Contracts\UsuarioContract;
use App\Contracts\TableroContract;
use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\ICrud;

class UsuarioDAO implements ICrud {

    public function __construct() {}

    public function delete($id): bool{

        $myPDO = DB::getPdo();
        $tablename = UsuarioContract::TABLE_NAME;
        $colid = UsuarioContract::COL_ID;



        $sql = "DELETE FROM $tablename WHERE $colid  = :id";

        $stmt = $myPDO->prepare($sql);
        return $stmt->execute([':id' => $id]);
        $filasAfectadas = $stmt->rowCount();
        return $filasAfectadas > 0;
    }


    public function update($p): bool
    {

        $colid = UsuarioContract::COL_ID;
        $colnombre = UsuarioContract::COL_NOMBRE;
        $colpassword = UsuarioContract::COL_PASSWORD;
        $colrol = UsuarioContract::COL_ROL;

        $tablename = UsuarioContract::TABLE_NAME;
        $myPDO = DB::getPdo();
        if (!($p->getId() > 0)) {
            return false;
        }
        $sql = "UPDATE $tablename ".
               " SET $colnombre = :nombre " .
               " $colpassword = :password " .
               " $colrol = :rol " .
               " WHERE $colid = :id";


        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nombre' => $p->getNombre(),
                    ':id' => $p->getId(),
                    ':password' => $p->getPassword(),
                    ':rol' => $p->getPassword()

                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();



            if ($filasAfectadas > 0) {

                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return false;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza Usuariolback";
            var_dump($ex);
            $myPDO->rollBack();
            return false;
        }
        $stmt = null;
        return true;
    }


    public function findById($id): object | null
    {

        $tablename = UsuarioContract::TABLE_NAME;
        $colid = UsuarioContract::COL_ID;

        $sql = "SELECT * FROM $tablename WHERE $colid = :id";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new Usuario();

            $p->setId($row[UsuarioContract::COL_ID]);
            $p->setNombre($row[UsuarioContract::COL_NOMBRE]);
            $p->setPassword($row[UsuarioContract::COL_PASSWORD]);
            $p->setRol($row[UsuarioContract::COL_ROL]);

            return $p;
        }

        return null;
    }


    public function findAll(): array
    {

        $tablename = UsuarioContract::TABLE_NAME;

        $sql = "SELECT * FROM $tablename";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $Usuarios = [];
        while ($row = $stmt->fetch()) {
            $p = new Usuario();
            $p->setId($row[UsuarioContract::COL_ID]);
            $p->setNombre($row[UsuarioContract::COL_NOMBRE]);
            $p->setPassword($row[UsuarioContract::COL_PASSWORD]);
            $p->setRol($row[UsuarioContract::COL_ROL]);

            $Usuarios[] = $p;
        }

        return $Usuarios;
    }

    public function save($p): object | null
    {
        $myPDO = DB::getPdo();
        $tablename = UsuarioContract::TABLE_NAME;
        //$colid = UsuarioContract::COL_ID;
        $colnombre = UsuarioContract::COL_NOMBRE;
        $colpassword = UsuarioContract::COL_PASSWORD;
        $colrol = UsuarioContract::COL_ROL;

        $sql =
        "INSERT INTO $tablename ( $colnombre, $colpassword, $colrol)
         VALUES(:nombre, :passwd, :rol)";

        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nombre' => $p->getNombre(),
                    ':passwd' => $p->getPassword(),
                    ':rol' => $p->getRol()

                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();



            //forzamos un Usuariolback aleatorio para ver que deshace los cambios
            if ($filasAfectadas > 0) {
                //obtenemos el id generado con:
                $idgenerado = $myPDO->lastInsertId();
                $p->setId($idgenerado);
                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return null;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza Usuariolback";
            var_dump($ex);
            $myPDO->rollBack();
            return null;
        }
        $stmt = null;

        return $p;
    }





}
