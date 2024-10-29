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

    public function associateFigureWithBoard($boardId) {
        $myPDO = DB::getPdo();

        $tablename = FigureBoardContract::TABLE_NAME;
        $colId = FigureBoardContract::COL_FIGURE_ID;
        $colBoardId = FigureBoardContract::COL_BOARD_ID;
        $colFigureId = FigureBoardContract::COL_FIGURE_ID;
        $colPosition = FigureBoardContract::COL_POSITION;

        $sql = "INSERT INTO $tablename ($colBoardId, $colFigureId, $colPosition) 
        VALUES (:boardId, :figureId, :position)";
    
        try {
            $stmt = $myPDO->prepare($sql);
            for($i=0;$i<40;$i++){
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
            var_dump($ex);
            return null;
        }
    
        return true;
    }
    
}


?>