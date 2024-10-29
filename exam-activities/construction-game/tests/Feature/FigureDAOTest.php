<?php

namespace Tests\Feature;

use App\DAO\FigureDAO;
use App\Models\Figure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class FigureDAOTest extends TestCase
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

        $figureDAO = new FigureDAO($pdo);

        $figureList = $figureDAO->findAll();

        assertTrue(count($figureList) == 2, self::MESSAGE_ERROR);
    }

    public function test_002_findById(): void {
        $pdo = DB::getPdo();

        $figureDAO = new FigureDAO($pdo);

        $figureBBDD = $figureDAO->findById(1);

        $hexValue = '0x89504e470d0'; 
        $decimalValue = hexdec($hexValue);

        assertTrue($figureBBDD->getId() == 1, self::MESSAGE_ERROR);
        //dd($figureBBDD->getImage());
        
        assertTrue($figureBBDD->getImage() == $decimalValue, self::MESSAGE_ERROR);
        assertTrue($figureBBDD->getTypeImage() == "image/png", self::MESSAGE_ERROR);
    }

    public function test_003_delete(): void {
        try {
        $pdo = DB::getPdo();

        $figureDAO = new FigureDAO($pdo);

        DB::beginTransaction();
        $figureDAO->delete(1);
        $figureList = $figureDAO->findAll();

        assertTrue(count($figureList) == 1, self::MESSAGE_ERROR);

        } finally{
            DB::rollBack();
        }
    }

    public function test_004_delete(): void {
        $pdo = DB::getPdo();

        $figureDAO = new FigureDAO($pdo);

        $figureDAO->delete(1);
        $figureList = $figureDAO->findAll();

        assertTrue(count($figureList) == 1, self::MESSAGE_ERROR);
    }

    public function test_005_update(): void {
        $pdo = DB::getPdo();
        $figureDAO = new FigureDAO($pdo);

        $figureToAdd = new Figure();
        $figureToAdd->setImage("0x89504e470d0a1a0a00");
        $figureToAdd->setTypeImage("image/png");
        $figureDAO->save($figureToAdd);

        $figureBBDD = $figureDAO->findById(3);
        $figureToUpdate = $figureBBDD;
        $figureToUpdate->setImage("0x89504e488b84b048088");
        $figureToUpdate->setTypeImage("image/jpg");

        $figureDAO->update($figureToUpdate);

        $figureList = $figureDAO->findAll();

        assertTrue(count($figureList) == 3, self::MESSAGE_ERROR);

        assertTrue($figureToUpdate->getTypeImage() == $figureBBDD->getTypeImage(), self::MESSAGE_ERROR);
        assertTrue($figureToUpdate->getImage() == $figureBBDD->getImage(), self::MESSAGE_ERROR);
        assertTrue($figureToUpdate->getId() == $figureBBDD->getId(), self::MESSAGE_ERROR);

    }

    public function test_006_save(): void {
        $pdo = DB::getPdo();

        $figureDAO = new FigureDAO($pdo);

        $figureToAdd = new Figure();
        $figureToAdd->setImage("0x89504e470d0a1a0a00");
        $figureToAdd->setTypeImage("image/png");
        $figureDAO->save($figureToAdd);

        $figureToAdd->setId(3);


        $figureList = $figureDAO->findAll();

        $figureBBDD = $figureDAO->findById(3);

        assertTrue(count($figureList) == 3, self::MESSAGE_ERROR);
        assertTrue($figureToAdd->getTypeImage() == $figureBBDD->getTypeImage(), self::MESSAGE_ERROR);
        assertTrue($figureToAdd->getImage() == $figureBBDD->getImage(), self::MESSAGE_ERROR);
        assertTrue($figureToAdd->getId() == $figureBBDD->getId(), self::MESSAGE_ERROR);

    }
}
