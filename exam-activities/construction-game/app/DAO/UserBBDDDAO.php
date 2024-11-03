<?php
namespace App\DAO;

use App\Contracts\UserBBDDContract;
use App\Models\UserBBDD;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;
use App\DAO\Interface\ICrud;
/**
 * @author Nabil L. A.
 */
class UserBBDDDAO implements ICrud {

    protected $boardDAO;
    /**
     * Default constructor
     */
    public function __construct() {
        $this->boardDAO = new BoardDAO();
    }

    /**
     * Function to delete a user 
     */
    public function delete($id): bool{

        $myPDO = DB::getPdo();

        $boards = $this->boardDAO->findAllBoardsPerUser($id);

        try {
            
            foreach($boards as $board){
                $this->boardDAO->delete($board->getId());
            }

        } catch(Exception $e){
            throw new Exception("Error while deleting board: ". $e->getMessage());
        }


        $tablename = UserBBDDContract::TABLE_NAME;
        $colid = UserBBDDContract::COL_ID;

        $sql = "DELETE FROM $tablename WHERE $colid = :id";

        $stmt = $myPDO->prepare($sql);
        $stmt->execute([':id' => $id]);
        $affectedRows = $stmt->rowCount();

        return $affectedRows > 0;
    }

    /**
     * Function to update a user 
     */
    public function update($p): bool{

        $colid = UserBBDDContract::COL_ID;
        $colname = UserBBDDContract::COL_NAME;
        $colpassword = UserBBDDContract::COL_PASSWORD;
        $colrol = UserBBDDContract::COL_ROL;

        $tablename = UserBBDDContract::TABLE_NAME;
        $myPDO = DB::getPdo();
       
        $sql = "UPDATE $tablename ".
               " SET $colname = :nombre, " .
               " $colpassword = :password, " .
               " $colrol = :rol " .
               " WHERE $colid = :id";

               
        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
           
            $stmt->execute(
                [
                    ':nombre' => $p->getName(),
                    ':id' => $p->getId(),
                    ':password' => $p->getPassword(),
                    ':rol' => $p->getRol()

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


    /**
     * Function to find an user by id
     */
    public function findById($id): object | null {

        $tablename = UserBBDDContract::TABLE_NAME;
        $colid = UserBBDDContract::COL_ID;

        $sql = "SELECT * FROM $tablename WHERE $colid = :id";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new UserBBDD();

            $p->setId($row[UserBBDDContract::COL_ID]);
            $p->setName($row[UserBBDDContract::COL_NAME]);
            $p->setPassword($row[UserBBDDContract::COL_PASSWORD]);
            $p->setRol($row[UserBBDDContract::COL_ROL]);

            return $p;
        }

        return null;
    }


    /**
     * Function to find the user by username
     */
    public function findByUsername($username): object | null {
        $tablename = UserBBDDContract::TABLE_NAME;
        $colname = UserBBDDContract::COL_NAME;

        $sql = "SELECT * FROM $tablename WHERE $colname = :username";

        $myPDO = DB::getPdo();

        $stmt = $myPDO->prepare($sql);

        $stmt->execute([':username' => $username]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $p = new UserBBDD();

            $p->setId($row[UserBBDDContract::COL_ID]);
            $p->setName($row[UserBBDDContract::COL_NAME]);
            $p->setPassword($row[UserBBDDContract::COL_PASSWORD]);
            $p->setRol($row[UserBBDDContract::COL_ROL]);

            return $p;
        }

        return null;
    }

    /**
     * Function to find all users 
     */
    public function findAll(): array{
        $tablename = UserBBDDContract::TABLE_NAME;

        $sql = "SELECT * FROM $tablename";

        $myPDO = DB::getPdo();
        $stmt = $myPDO->prepare($sql);
        $stmt->execute();
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $UserBBDDs = [];
        while ($row = $stmt->fetch()) {
            $p = new UserBBDD();
            $p->setId($row[UserBBDDContract::COL_ID]);
            $p->setName($row[UserBBDDContract::COL_NAME]);
            $p->setPassword($row[UserBBDDContract::COL_PASSWORD]);
            $p->setRol($row[UserBBDDContract::COL_ROL]);

            $UserBBDDs[] = $p;
        }

        return $UserBBDDs;
    }

    /**
     * Function to add a user
     */
    public function save($p): object | null{
        $myPDO = DB::getPdo();
        $tablename = UserBBDDContract::TABLE_NAME;
        $colname = UserBBDDContract::COL_NAME;
        $colpassword = UserBBDDContract::COL_PASSWORD;
        $colrol = UserBBDDContract::COL_ROL;

        $roleName = $p->getRol(); 
        $roleDAO = new RolDAO();

        $allRoles = $roleDAO->findAll();

        $rolId = 0;
        foreach ($allRoles as $role) {
            if ($role->getName() === $roleName) {
                $rolId = $role->getId();
                break;
            }
        }

        $sql =
        "INSERT INTO $tablename ($colname, $colpassword, $colrol)
         VALUES(:nombre, :passwd, :rol)";

        try {
            $myPDO->beginTransaction();
            $stmt = $myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nombre' => $p->getName(),
                    ':passwd' => $p->getPassword(),
                    ':rol' => $rolId
                ]
            );

            $affectedRows = $stmt->rowCount();

            if ($affectedRows > 0) {
                $idgenerado = $myPDO->lastInsertId();
                $p->setId($idgenerado);
                $myPDO->commit();
            } else {
                $myPDO->rollBack();
                return null;
            }
        } catch (Exception $ex) {
            var_dump($ex);
            $myPDO->rollBack();
            return null;
        }
        $stmt = null;

        return $p;
    }





}
