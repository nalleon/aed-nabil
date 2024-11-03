<?php

namespace Tests\Feature;

use App\DAO\RolDAO;
use App\Models\Rol;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class RolDAOTest extends TestCase
{

    public $databaseCreated = false;
    public function setUp(): void{
        parent::setUp();
        if(!$this->databaseCreated ){
            $pdo = DB::getPdo();
            require 'CreateDatabase.php';
            $this->databaseCreated = true;
        }
    }


    public function test_001_findAll(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rolList = $rolDAO->findAll();

        assertTrue(count($rolList) == 2, self::MESSAGE_ERROR);
    }


    public function test_002_findById(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);
        

        $rol = $rolDAO->findById(1);
        assertTrue($rol->getName() == "usuario", self::MESSAGE_ERROR);
        assertTrue($rol->getId() == "1", self::MESSAGE_ERROR);
    }


    public function test_003_delete(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rolToAdd = new Rol();
        $rolToAdd->setName("admin2");
        $rolDAO->save($rolToAdd);


        $rolDAO->delete(3);
        $rolList = $rolDAO->findAll();

        assertTrue(count($rolList) == 2, self::MESSAGE_ERROR);
    }

    public function test_004_update(): void {
        $pdo = DB::getPdo();
        $rolDAO = new RolDAO($pdo);

        $rolToAdd = new Rol();
        $rolToAdd->setName("admin2");
        $rolDAO->save($rolToAdd);
        $rolToAdd->setId(3);

        $rolToUpdate = $rolToAdd;
        $rolToUpdate->setName("admin3");

        $rolDAO->update($rolToUpdate);

        $rolList = $rolDAO->findAll();

        $rolBBDD = $rolDAO->findById(3);

        assertTrue(count($rolList) == 3, self::MESSAGE_ERROR);
        assertTrue($rolToUpdate == $rolBBDD, self::MESSAGE_ERROR);
        assertTrue($rolToUpdate->getName() == $rolBBDD->getName(), self::MESSAGE_ERROR);
        assertTrue($rolToUpdate->getId() == $rolBBDD->getId(), self::MESSAGE_ERROR);

    }

    public function test_005_save(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rolToAdd = new Rol();
        $rolToAdd->setName("admin2");

        $rolDAO->save($rolToAdd);
        $rolList = $rolDAO->findAll();

        $rolToAdd->setId(3);

        $rolBBDD = $rolDAO->findById(3);


        assertTrue(count($rolList) == 3, self::MESSAGE_ERROR);
        assertTrue($rolToAdd == $rolBBDD, self::MESSAGE_ERROR);
    }
}
