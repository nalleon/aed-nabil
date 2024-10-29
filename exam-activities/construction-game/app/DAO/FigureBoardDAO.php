<?php

namespace App\DAO;

use App\Contracts\FigureBoardContract;
use App\Contracts\FigureContract;
use App\Models\Board;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;
use App\Models\Figure;

class FigureBoardDAO {

    public function __construct() {}

    public function associateFigureWithBoard($boardId) {
        $myPDO = DB::getPdo();

        if (!$myPDO) {
            throw new Exception("No se pudo establecer la conexión a la base de datos.");
        }

        $tablename = FigureBoardContract::TABLE_NAME;
        $colBoardId = FigureBoardContract::COL_BOARD_ID;
        $colFigureId = FigureBoardContract::COL_FIGURE_ID;
        $colPosition = FigureBoardContract::COL_POSITION;

        $sql = "INSERT INTO $tablename ($colBoardId, $colFigureId, $colPosition) 
        VALUES (:boardId, :figureId, :position)";
    
        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);

            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta: " . implode(", ", $myPDO->errorInfo()));
            }

            for ($i = 0; $i < 15; $i++) {
                $stmt->execute([
                    ':boardId' => $boardId,
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
    
        return true;
    }
}



?>