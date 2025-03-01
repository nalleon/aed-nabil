<?php

namespace App\DAO;

use App\Contracts\BoardContract;

use App\Models\Board;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;

/**
 * @author Nabil L. A.
 */
class BoardDAO implements ICrud{
    
    protected $figureBoardDAO;
    /**
     * Default constructor
     */

    public function __construct() {
        $this->figureBoardDAO = new FigureBoardDAO();
    }

    /**
     * Function to delete a board 
     */
    public function delete($id): bool{
        $myPDO = DB::getPdo();

        try{
            $this->figureBoardDAO->deleteByBoardId($id);
        } catch(Exception $e){
            throw new Exception("Error while deleting from FigureBoard(figuras_tableros): ". $e->getMessage());
        }

        $tablename = BoardContract::TABLE_NAME;
        $colid = BoardContract::COL_ID;

        $sql = "DELETE FROM $tablename WHERE $colid  = :id";

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);
        $affectedRows = $stmt->rowCount();

        return $affectedRows > 0;
    }

    /**
     * Function to update a board
     */
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
        $sql =  "UPDATE $tablename ".
                " SET $colcontent = :content, " .
                " $coldate = :dateBoard, " .
                " $colname = :nameBoard, " .
                " $coluser = :userid " .
                " WHERE $colid = :id" ;


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
     * Function to find by id a board
     */
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


    /**
     * Function to find all boards
     */
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


    /**
     * Function to add a board
     */
    public function save($p): object | null {
        $myPDO = DB::getPdo();
        $tablename = BoardContract::TABLE_NAME;
        $colname = BoardContract::COL_NAME;
        $colcontent = BoardContract::COL_CONTENT;
        $coldate = BoardContract::COL_DATE;
        $coluser = BoardContract::COL_USER;

        $sql =
        "INSERT INTO $tablename ($coluser, $colname, $colcontent, $coldate)" .
        " VALUES(:userid, :nameBoard, :content, :dateBoard)";

        try {
            $myPDO->beginTransaction();

            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nameBoard' => $p->getName(),
                    ':content' => $p->getContent(),
                    ':dateBoard' => $p->getDate(),
                    ':userid' => $p->getUserId()
                ]
            );


            $affectedRows = $stmt->rowCount();

            if ($affectedRows > 0) {
                $idGenerated = $myPDO->lastInsertId();
                $p->setId($idGenerated);

                $this->figureBoardDAO->createBlankBoard($idGenerated);

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

    /**
     * Function to find all board from a user
     */
    public function findAllBoardsPerUser($userId): array {
        $tablename = BoardContract::TABLE_NAME;
        $colUserId = BoardContract::COL_USER;
        
        $sql = "SELECT * FROM $tablename
        WHERE $colUserId = $userId";

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
}


?>
