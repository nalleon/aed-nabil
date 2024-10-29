<?php

namespace Tests\Feature;

use App\DAO\UserBBDDDAO;
use App\Models\UserBBDD;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class UserBBDDDAOTest extends TestCase
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

        $userDAO = new UserBBDDDAO($pdo);

        $userList = $userDAO->findAll();

        assertTrue(count($userList) == 2, self::MESSAGE_ERROR);
    }

    public function test_002_findById(): void {
        $pdo = DB::getPdo();

        $userDAO = new UserBBDDDAO($pdo);

        $userBBDD = $userDAO->findById(1);

        assertTrue($userBBDD->getName() == "John Doe", self::MESSAGE_ERROR);
        assertTrue($userBBDD->getPassword() == "$2y$04$6q5niDLLHb.V8C0jcDQbgODNmJ5R.08EQDfmvcldDZeGINosjISQi", self::MESSAGE_ERROR);
        assertTrue($userBBDD->getRol() == 1, self::MESSAGE_ERROR);
        assertTrue($userBBDD->getId() == "1", self::MESSAGE_ERROR);
    }

    public function test_003_delete(): void {
        try {
        $pdo = DB::getPdo();

        $userDAO = new UserBBDDDAO($pdo);

        DB::beginTransaction();
        $userDAO->delete(1);
        $userList = $userDAO->findAll();

        assertTrue(count($userList) == 1, self::MESSAGE_ERROR);

        } finally{
            DB::rollBack();
        }
    }

    public function test_004_delete(): void {
        $pdo = DB::getPdo();

        $userDAO = new UserBBDDDAO($pdo);

        $userDAO->delete(1);
        $userList = $userDAO->findAll();

        assertTrue(count($userList) == 1, self::MESSAGE_ERROR);
    }

    public function test_005_update(): void {
        $pdo = DB::getPdo();
        $userDAO = new UserBBDDDAO($pdo);

        $userToAdd = new UserBBDD();
        $userToAdd->setName("testName");
        $userToAdd->setRol("usuario");
        $userToAdd->setPassword("passwordTest");
        $userDAO->save($userToAdd);

        $userBBDD = $userDAO->findById(3);
        $userToUpdate = $userBBDD;
        $userToUpdate->setName("testNameUpdate");
        $userToUpdate->setPassword("passwordUpdate");
        $userToUpdate->setRol("2");

        $userDAO->update($userToUpdate);

        $userList = $userDAO->findAll();

        assertTrue(count($userList) == 3, self::MESSAGE_ERROR);

        //dd($userToUpdate->getName(), $userBBDD->getName());
        assertTrue($userToUpdate->getName() == $userBBDD->getName(), self::MESSAGE_ERROR);
        assertTrue($userToUpdate->getPassword() == $userBBDD->getPassword(), self::MESSAGE_ERROR);
        assertTrue("2" == $userBBDD->getRol(), self::MESSAGE_ERROR);
        assertTrue($userToUpdate->getId() == $userBBDD->getId(), self::MESSAGE_ERROR);

    }

    public function test_006_save(): void {
        $pdo = DB::getPdo();

        $userDAO = new UserBBDDDAO($pdo);

        $userToAdd = new UserBBDD();
        $userToAdd->setName("testName");
        $userToAdd->setRol("usuario");
        $userToAdd->setPassword("passwordTest");
        $userToAdd->setId(3);
        $userDAO->save($userToAdd);


        $userList = $userDAO->findAll();

        $userBBDD = $userDAO->findById(3);

        assertTrue(count($userList) == 3, self::MESSAGE_ERROR);
        assertTrue($userToAdd->getName() == $userBBDD->getName(), self::MESSAGE_ERROR);
        assertTrue($userToAdd->getPassword() == $userBBDD->getPassword(), self::MESSAGE_ERROR);
        assertTrue("1" == $userBBDD->getRol(), self::MESSAGE_ERROR);
        assertTrue($userToAdd->getId() == $userBBDD->getId(), self::MESSAGE_ERROR);

    }
}
