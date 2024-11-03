<?php

namespace Tests\Feature;

use App\DAO\BoardDAO;
use App\DAO\FigureBoardDAO;
use App\Models\Board;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class FigureBoardDAOTest extends TestCase
{
    public $databaseCreated = false;
    public function setUp(): void{
        parent::setUp();
        if(! $this->databaseCreated ){
            $pdo = DB::getPdo();
            require 'CreateDatabase.php';
            $this->databaseCreated = true;
        }
    }



    public function test_001_findAll(): void {
        $pdo = DB::getPdo();

        $figureBoardDAO = new FigureBoardDAO($pdo);

        $figureBoardList = $figureBoardDAO->findAll();

        assertTrue(count($figureBoardList) == 2, self::MESSAGE_ERROR);
    }

    public function test_002_findById(): void {
        $pdo = DB::getPdo();

        $figureBoardDAO = new FigureBoardDAO($pdo);

        $figureBoardBBDD = $figureBoardDAO->findById(1);

        assertTrue($figureBoardBBDD->getPosition() === 1, self::MESSAGE_ERROR);
        assertTrue($figureBoardBBDD->getBoardId() === 1, self::MESSAGE_ERROR);
        assertTrue($figureBoardBBDD->getFigureId() === 1, self::MESSAGE_ERROR);
        assertTrue($figureBoardBBDD->getId() === 1, self::MESSAGE_ERROR);
    }


    public function test_003_delete(): void {
        $pdo = DB::getPdo();

        $figureBoardDAO = new FigureBoardDAO($pdo);

        $figureBoardDAO->delete(2);
        
        $figureBoardList = $figureBoardDAO->findAll();

        assertTrue(count($figureBoardList) == 1, self::MESSAGE_ERROR);
    }

    public function test_004_update(): void {
        $pdo = DB::getPdo();
        $figureBoardDAO = new FigureBoardDAO($pdo);
        
        $boardDAO = new BoardDAO();
        $boardToAdd = new Board();

        $boardToAdd->setContent("Content");
        $boardToAdd->setUserId(1);
        $boardToAdd->setName("NameBoard");
        $boardToAdd->setDate(2025);

        $boardDAO->save($boardToAdd);


        $figureBoardDAO->save($boardToAdd);

        $figureBoardList = $figureBoardDAO->findAll();

       

        $figureBoardBBDD = $figureBoardDAO->findById(3);
        $figureBoardToUpdate = $figureBoardBBDD;

        $figureBoardToUpdate->setBoardId(3);
        $figureBoardToUpdate->setFigureId(2);
        $figureBoardToUpdate->setPosition(20);

        $figureBoardDAO->update($figureBoardToUpdate);


        $figureBoardBBDD = $figureBoardDAO->findById(3);
        $figureBoardList = $figureBoardDAO->findAll();
        assertTrue(count($figureBoardList) == 17, self::MESSAGE_ERROR);

       // dd($figureBoardToUpdate, $figureBoardToUpdate);
        
        assertTrue($figureBoardToUpdate->getPosition() === $figureBoardBBDD->getPosition(), self::MESSAGE_ERROR);
        assertTrue($figureBoardToUpdate->getBoardId() === $figureBoardBBDD->getBoardId(), self::MESSAGE_ERROR);
        assertTrue($figureBoardToUpdate->getFigureId() === $figureBoardBBDD->getFigureId(), self::MESSAGE_ERROR);
        assertTrue($figureBoardToUpdate->getId() === $figureBoardBBDD->getId(), self::MESSAGE_ERROR);

    }

    public function test_005_save(): void {
        $pdo = DB::getPdo();

        $figureBoardDAO = new FigureBoardDAO($pdo);
        
        $boardDAO = new BoardDAO();
        $boardToAdd = new Board();

        $boardToAdd->setContent("Content");
        $boardToAdd->setUserId(1);
        $boardToAdd->setName("NameBoard");
        $boardToAdd->setDate(2025);

        $boardDAO->save($boardToAdd);


        $figureBoardDAO->save($boardToAdd);

        $figureBoardList = $figureBoardDAO->findAll();
        assertTrue(count($figureBoardList) == 17, self::MESSAGE_ERROR);


        $figureBoardBBDD = $figureBoardDAO->findById(3);
        
        assertTrue($figureBoardBBDD->getPosition() == 0, self::MESSAGE_ERROR);
        assertTrue($figureBoardBBDD->getBoardId() == 3, self::MESSAGE_ERROR);
        assertTrue($figureBoardBBDD->getFigureId() == 1, self::MESSAGE_ERROR);
        assertTrue($figureBoardBBDD->getId() == 3, self::MESSAGE_ERROR);
        
    }
}
