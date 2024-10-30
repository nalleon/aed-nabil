<?php

namespace App\DAO;

use App\Contracts\BoardContract;
use App\Contracts\FigureBoardContract;
use App\Contracts\FigureContract;
use App\Models\Board;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;
use App\Models\Figure;
use App\Models\FigureBoard;

class FigureBoardDAO implements ICrud{

    public function __construct() {}

    public function delete($id): bool{

        $myPDO = DB::getPdo();
        $tablename = FigureBoardContract::TABLE_NAME;
        $colid = FigureBoardContract::COL_ID;
        

        $sql = "DELETE FROM $tablename WHERE $colid  = :id";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':id' => $id]);
        $affectedRows = $stmt->rowCount();

        return $affectedRows > 0;
    }

    /**
     * Functiuon to delete all figures from the same board
     */
    public function deleteByBoardId($boardId): bool{

        $myPDO = DB::getPdo();
        $tablename = FigureBoardContract::TABLE_NAME;
        $colBoardId = FigureBoardContract::COL_BOARD_ID;

        $sql = "DELETE FROM $tablename WHERE $colBoardId  = :boardId";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':boardId' => $boardId]);
        $affectedRows = $stmt->rowCount();

        return $affectedRows > 0;
    }


    public function update($p): bool{
        $colid = FigureBoardContract::COL_ID;
        $colBoardId = FigureBoardContract::COL_BOARD_ID;
        $colFigureId = FigureBoardContract::COL_FIGURE_ID;
        $colPosition = FigureBoardContract::COL_POSITION;

        $tablename = FigureBoardContract::TABLE_NAME;
        $myPDO = DB::getPdo();

        if (!($p->getId() > 0)) {
            return false;
        }
        $sql = "UPDATE $tablename ".
               " SET $colBoardId = :boardId, " .
               " $colFigureId = :figureId, " .
               " $colPosition = :position, " .
               " WHERE $colid = :id" ;


        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':boardId' => $p->getBoardId(),
                    ':id' => $p->getId(),
                    ':figureId' => $p->getFigureId(),
                    ':position' => $p->getPosition(),
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


    public function findById($id): object | null {
        $tablename = FigureBoardContract::TABLE_NAME;
        $colid = FigureBoardContract::COL_ID;

        $sql = "SELECT * FROM $tablename WHERE $colid = :id";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new FigureBoard();

            $p->setId($row[FigureBoardContract::COL_ID]);
            $p->setBoardId($row[FigureBoardContract::COL_BOARD_ID]);
            $p->setFigureId($row[FigureBoardContract::COL_FIGURE_ID]);
            $p->setPosition($row[FigureBoardContract::COL_POSITION]);

            return $p;
        }

        return null;
    }


    public function findAll(): array{
        $tablename = FigureBoardContract::TABLE_NAME;

        $sql = "SELECT * FROM $tablename";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $figuresInBoard = [];
        while ($row = $stmt->fetch()) {
            $p = new FigureBoard();

            $p->setId($row[FigureBoardContract::COL_ID]);
            $p->setBoardId($row[FigureBoardContract::COL_BOARD_ID]);
            $p->setFigureId($row[FigureBoardContract::COL_FIGURE_ID]);
            $p->setPosition($row[FigureBoardContract::COL_POSITION]);

            $figuresInBoard[] = $p;
        }

        return $figuresInBoard;
    }
 

    public function save($p): object | null {
        $myPDO = DB::getPdo();

        $tablename = FigureBoardContract::TABLE_NAME;
        $colBoardId = FigureBoardContract::COL_BOARD_ID;
        $colFigureId = FigureBoardContract::COL_FIGURE_ID;
        $colPosition = FigureBoardContract::COL_POSITION;

        $sql = "INSERT INTO $tablename ($colBoardId, $colFigureId, $colPosition) 
        VALUES (:boardId, :figureId, :position)";
    
        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);

            for ($i = 0; $i < 15; $i++) {
                $stmt->execute([
                    ':boardId' => $p->getId(),
                    ':figureId' => 1, 
                    ':position' => $i,
                ]);
            }

            $affectedRows = $stmt->rowCount();

            if ($affectedRows > 0) {
                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return null;
            }

        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
            $myPDO->rollBack();
            return null;
        }
    
        return $p;
    }

    public function getContentsByBoard($boardId) {
        $tablename = FigureBoardContract::TABLE_NAME;
        $colBoardId = FigureBoardContract::COL_BOARD_ID;

        $sql = "SELECT * FROM $tablename 
        WHERE $colBoardId = $boardId";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $boardContents = [];
        while ($row = $stmt->fetch()) {
            $p = new FigureBoard();
            $p->setId($row[FigureBoardContract::COL_ID]);
            $p->setBoardId($row[FigureBoardContract::COL_BOARD_ID]);
            $p->setFigureId($row[FigureBoardContract::COL_FIGURE_ID]);
            $p->setPosition($row[FigureBoardContract::COL_POSITION]);

            $boardContents[] = $p;
        }

        return $boardContents;
    }

    /**
     * Function to retrieve the figures on a specific board
     */
    public function getFiguresByBoard($boardId) {
        $myPDO = DB::getPdo();

        $tablenameFigure = FigureContract::TABLE_NAME;
        $tablenameFigureBoard = FigureBoardContract::TABLE_NAME;

        $colFigureIdFromFigure = FigureContract::COL_ID;
        $colFigureIdFromFigureBoard = FigureBoardContract::COL_FIGURE_ID;

        $colBoardId = FigureBoardContract::COL_BOARD_ID;

        $figures = [];

        $sql = "SELECT f.* FROM $tablenameFigure AS f
                INNER JOIN $tablenameFigureBoard AS fb
                ON f.$colFigureIdFromFigure = fb.$colFigureIdFromFigureBoard
                WHERE fb.$colBoardId = :boardId";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':boardId' => $boardId]);
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
     * Function to create the blank initial board
     */
    public function createBlankBoard($boardId) {
        $myPDO = DB::getPdo();
        
        $tablenameFigureBoard = FigureBoardContract::TABLE_NAME;
        $colBoardId = FigureBoardContract::COL_BOARD_ID;
        $colFigureId = FigureBoardContract::COL_FIGURE_ID;
        $colPosition = FigureBoardContract::COL_POSITION;

        $sqlFigureTabla = "INSERT INTO $tablenameFigureBoard ($colBoardId, $colFigureId, $colPosition)
        VALUES (:boardId, :figureId, :position)";

        $stmtFigureBoard = $myPDO->prepare($sqlFigureTabla);
        for ($i = 0; $i < 15; $i++) {
            $stmtFigureBoard->execute([
                ':boardId' => (int) $boardId,
                ':figureId' => 1,
                ':position' => $i,
            ]);

        }

        $affectedRows = $stmtFigureBoard->rowCount();

        return $affectedRows > 0;
    }
}



?>