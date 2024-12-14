<?php

namespace Tests\Feature;

use App\DAO\BoardDAO;
use App\Models\Board;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class BoardDAOTest extends TestCase
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

        $boardDAO = new BoardDAO($pdo);

        $boardList = $boardDAO->findAll();

        assertTrue(count($boardList) == 2, self::MESSAGE_ERROR);
    }

    public function test_002_findById(): void {
        $pdo = DB::getPdo();

        $boardDAO = new BoardDAO($pdo);

        $boardBBDD = $boardDAO->findById(1);

        assertTrue($boardBBDD->getId() == 1, self::MESSAGE_ERROR);
        assertTrue($boardBBDD->getUserId() == 1, self::MESSAGE_ERROR);
        assertTrue($boardBBDD->getName() == 'Board  of John Doe', self::MESSAGE_ERROR);
        assertTrue($boardBBDD->getContent() == 'Content of board', self::MESSAGE_ERROR);
        assertTrue($boardBBDD->getDate() == 2024, self::MESSAGE_ERROR);
    }


    public function test_003_delete(): void {
        $pdo = DB::getPdo();

        $boardDAO = new BoardDAO($pdo);

        $boardDAO->delete(2);
        
        $boardList = $boardDAO->findAll();

        assertTrue(count($boardList) == 1, self::MESSAGE_ERROR);
    }

    public function test_004_update(): void {
        $pdo = DB::getPdo();
        $boardDAO = new BoardDAO($pdo);

        $boardToAdd = new Board();
        $boardToAdd->setContent("Content");
        $boardToAdd->setUserId(1);
        $boardToAdd->setName("NameBoard");
        $boardToAdd->setDate(2025);

        $boardDAO->save($boardToAdd);

        $boardBBDD = $boardDAO->findById(3);
        $boardToUpdate = $boardBBDD;
        $boardToUpdate->setContent("ContentUpdate");
        $boardToUpdate->setUserId(2);
        $boardToUpdate->setName("NameBoardUpdate");
        $boardToUpdate->setDate(2025);

        $boardDAO->update($boardToUpdate);

        $boardList = $boardDAO->findAll();

        assertTrue(count($boardList) == 3, self::MESSAGE_ERROR);

        assertTrue($boardToUpdate->getName() == $boardBBDD->getName(), self::MESSAGE_ERROR);
        assertTrue($boardToUpdate->getContent() == $boardBBDD->getContent(), self::MESSAGE_ERROR);
        assertTrue($boardToUpdate->getDate() == $boardBBDD->getDate(), self::MESSAGE_ERROR);
        assertTrue($boardToUpdate->getId() == $boardBBDD->getId(), self::MESSAGE_ERROR);

    }

    public function test_005_save(): void {
        $pdo = DB::getPdo();

        $boardDAO = new BoardDAO($pdo);

        $boardToAdd = new Board();
        $boardToAdd->setUserId(1);
        $boardToAdd->setContent("Content");
        $boardToAdd->setName("NameBoard");
        $boardToAdd->setDate(2025);

        $boardDAO->save($boardToAdd);

        $boardToAdd->setId(3);

        $boardList = $boardDAO->findAll();

        $boardBBDD = $boardDAO->findById(3);

        assertTrue(count($boardList) == 3, self::MESSAGE_ERROR);

        assertTrue($boardToAdd->getName() == $boardBBDD->getName(), self::MESSAGE_ERROR);
        assertTrue($boardToAdd->getContent() == $boardBBDD->getContent(), self::MESSAGE_ERROR);
        assertTrue($boardToAdd->getDate() == $boardBBDD->getDate(), self::MESSAGE_ERROR);
        assertTrue($boardToAdd->getId() == $boardBBDD->getId(), self::MESSAGE_ERROR);
    }
}
