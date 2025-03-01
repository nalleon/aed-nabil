<?php

namespace App\DAO;

use App\Contracts\FigureContract;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;
use App\Models\Figure;
/**
 * @author Nabil L. A.
 */
class FigureDAO implements ICrud{

    protected $figureBoardDAO;
    /**
     * Default constructor
     */
    public function __construct() {
        $this->figureBoardDAO = new FigureBoardDAO();
    }

    /**
     * Function to delete a figure
     */

    public function delete($id): bool{
        $myPDO = DB::getPdo();

        try{
            $this->figureBoardDAO->clearByImgId($id);
        } catch(Exception $e){
            throw new Exception("Error while deleting board: ". $e->getMessage());
        }

        $tablename = FigureContract::TABLE_NAME;
        $colid = FigureContract::COL_ID;

        $sql = "DELETE FROM $tablename WHERE $colid  = :id";


        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':id' => $id]);
        $affectedRows = $stmt->rowCount();

        return $affectedRows > 0;
    }


    /**
     * Function to update a figure
     */
    public function update($p): bool{

        $colid = FigureContract::COL_ID;
        $colimg = FigureContract::COL_IMG;
        $coltype = FigureContract::COL_TYPE;
    
        $tablename = FigureContract::TABLE_NAME;
        $myPDO = DB::getPdo();
        if (!($p->getId() > 0)) {
            return false;
        }
        $sql = "UPDATE $tablename ".
               " SET $colimg = :img, " .
               " $coltype = :typeImg " .
               " WHERE $colid = :id" ;


        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $p->getId(),
                    ':typeImg' => $p->getTypeImage(),
                    ':img' => $p->getImage(),
                ]
            );

            $affectedRows = $stmt->rowCount();

            if ($affectedRows > 0) {
                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return false;
            }
        } catch (Exception $ex) {
            var_dump($ex);
            $myPDO->rollBack();
            return false;
        }
        $stmt = null;
        return true;
    }


    /**
     * Function to find by id a figure
     */
    public function findById($id): object | null {

        $tablename = FigureContract::TABLE_NAME;
        $colid = FigureContract::COL_ID;


        $sql = "SELECT * FROM $tablename WHERE $colid = :id";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new Figure();

            $p->setId($row[FigureContract::COL_ID]);
            $p->setImage($row[FigureContract::COL_IMG]);
            $p->setTypeImage($row[FigureContract::COL_TYPE]);

            return $p;
        }

        return null;
    }


    /**
     * Function to find all figures
     */
    public function findAll(): array{

        $tablename = FigureContract::TABLE_NAME;

        $sql = "SELECT * FROM $tablename";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $figures = [];
        while ($row = $stmt->fetch()) {
            $p = new Figure();

            $p->setId($row[FigureContract::COL_ID]);
            $p->setImage($row[FigureContract::COL_IMG]);
            $p->setTypeImage($row[FigureContract::COL_TYPE]);

            $figures[] = $p;
        }

        return $figures;
    }

    
    /**
     * Function to add a figure
     */
    public function save($p): object | null{
        $myPDO = DB::getPdo();
        $tablename = FigureContract::TABLE_NAME;
        $colimg = FigureContract::COL_IMG;
        $coltype = FigureContract::COL_TYPE;

        $sql =
        "INSERT INTO $tablename ( $colimg, $coltype)
         VALUES(:img, :typeImg)";

        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':typeImg' => $p->getTypeImage(),
                    ':img' => $p->getImage(),
                ]
            );

            $affectedRows = $stmt->rowCount();

            if ($affectedRows > 0) {
                $idGenerated = $myPDO->lastInsertId();
                $p->setId($idGenerated);
                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return null;
            }
        } catch (Exception $ex) {
            var_dump($ex);
            $myPDO->rollBack();
            return null;
        }
        $stmt = null;

        return $p;
    }

}


?>
