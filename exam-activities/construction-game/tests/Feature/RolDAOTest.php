<?php

namespace Tests\Feature;

use App\DAO\RolDAO;
use App\Models\Rol;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class RolDAOTest extends TestCase
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


    /**
     * A basic feature test example.
     */
    public function test_001_findAll(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rolList = $rolDAO->findAll();

        assertTrue(count($rolList) == 2);
    }

        /**
     * A basic feature test example.
     */
    public function test_002_findById(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rol = $rolDAO->findById(1);
        assertTrue($rol->getName() == "usuario");
        assertTrue($rol->getId() == "1");
    }

    public function test_003_delete(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rol = $rolDAO->delete(1);
        $rolList = $rolDAO->findAll();

        assertTrue(count($rolList) == 1);
    }

    public function test_004_delete(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rol = $rolDAO->delete(1);
        $rolList = $rolDAO->findAll();

        assertTrue(count($rolList) == 1);
    }

    public function test_005_update(): void {
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

        assertTrue(count($rolList) == 3);
        assertTrue($rolToUpdate == $rolBBDD);
        assertTrue($rolToUpdate->getName() == $rolBBDD->getName());
        assertTrue($rolToUpdate->getId() == $rolBBDD->getId());

    }

    public function test_006_save(): void {
        $pdo = DB::getPdo();

        $rolDAO = new RolDAO($pdo);

        $rolToAdd = new Rol();
        $rolToAdd->setName("admin2");

        $rolDAO->save($rolToAdd);
        $rolList = $rolDAO->findAll();

        $rolToAdd->setId(3);

        $rolBBDD = $rolDAO->findById(3);


        assertTrue(count($rolList) == 3);
        assertTrue($rolToAdd == $rolBBDD);

    }
}
