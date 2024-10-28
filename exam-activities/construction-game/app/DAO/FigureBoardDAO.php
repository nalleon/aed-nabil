<?php

namespace App\DAO;

use App\Contracts\FigureContract;
use App\Models\Board;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;
use App\Models\Figure;

class FigureBoardDAO {

    public function associateFigureWithBoard($boardId, $figureId, $position) {
        $myPDO = DB::getPdo();
    
        $sql = "INSERT INTO figuras_tableros (tablero_id, figura_id, posicion) 
        VALUES (:boardId, :figureId, :position)";
    
        try {
            $stmt = $myPDO->prepare($sql);
            $stmt->execute([
                ':boardId' => $boardId,
                ':figureId' => $figureId,
                ':position' => $position,
            ]);

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