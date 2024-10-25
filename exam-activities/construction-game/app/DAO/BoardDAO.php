<?php

namespace App\DAO;

use App\Contracts\BoardContract;
use App\Models\Board;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;

class BoardDAO implements ICrud{

    public function __construct() {}

    public function delete($id): bool{

        $myPDO = DB::getPdo();
        $tablename = BoardContract::TABLE_NAME;
        $colid = BoardContract::COL_ID;

        $sql = "DELETE FROM $tablename WHERE $colid  = :id";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':id' => $id]);
        $affectedRows = $stmt->rowCount();

        return $affectedRows > 0;
    }


    public function update($p): bool{

        $colid = BoardContract::COL_ID;
        $colname = BoardContract::COL_NAME;
        $colcontent = BoardContract::COL_CONTENT;
        $coldate = BoardContract::COL_DATE;
        $coluser = BoardContract::COL_USER;

        $tablename = BoardContract::TABLE_NAME;
        $myPDO = DB::getPdo();
        if (!($p->getId() > 0)) {
            return false;
        }
        $sql = "UPDATE $tablename ".
               " SET $colcontent = :content " .
               " $coldate = :dateBoard " .
               " $colname = :nameBoard " .
               " WHERE $colid = :id AND $coluser = :userid" ;


        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nameBoard' => $p->getName(),
                    ':id' => $p->getId(),
                    ':content' => $p->getContent(),
                    ':dateBoard' => $p->getDate(),
                    ':userid' => $p->getUserId()

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

        $tablename = BoardContract::TABLE_NAME;
        $colid = BoardContract::COL_ID;


        $sql = "SELECT * FROM $tablename WHERE $colid = :id";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new Board();

            $p->setId($row[BoardContract::COL_ID]);
            $p->setName($row[BoardContract::COL_NAME]);
            $p->setContent($row[BoardContract::COL_CONTENT]);
            $p->setDate($row[BoardContract::COL_DATE]);
            $p->setUserId($row[BoardContract::COL_USER]);

            return $p;
        }

        return null;
    }


    public function findAll(): array{

        $tablename = BoardContract::TABLE_NAME;

        $sql = "SELECT * FROM $tablename";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $boards = [];
        while ($row = $stmt->fetch()) {
            $p = new Board();

            $p->setId($row[BoardContract::COL_ID]);
            $p->setName($row[BoardContract::COL_NAME]);
            $p->setContent($row[BoardContract::COL_CONTENT]);
            $p->setDate($row[BoardContract::COL_DATE]);
            $p->setUserId($row[BoardContract::COL_USER]);

            $boards[] = $p;
        }

        return $boards;
    }

    public function save($p): object | null
    {
        $myPDO = DB::getPdo();
        $tablename = BoardContract::TABLE_NAME;
        $colid = BoardContract::COL_ID;
        $colname = BoardContract::COL_NAME;
        $colcontent = BoardContract::COL_CONTENT;
        $coldate = BoardContract::COL_DATE;
        $coluser = BoardContract::COL_USER;

        $sql =
        "INSERT INTO $tablename ( $colcontent, $coldate, $colname, $coluser)
         VALUES(:content, :dateBoard, :nameBoard, :userid)";

        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nameBoard' => $p->getName(),
                    ':id' => $p->getId(),
                    ':content' => $p->getContent(),
                    ':dateBoard' => $p->getDate(),
                    ':userid' => $p->getUserId()
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


?>
