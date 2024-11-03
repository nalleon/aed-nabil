<?php
namespace App\DAO;

use App\DAO\Interface\ICrud;
use App\Models\Mapper\UserMapper;

class UserFileDAO implements ICrud {

    protected const FILE_PATH =  "C:\Users\\nabil\\repositorios-git\aed-nabil\\exam-activities\construction-game\storage\app\users.dat";
    private $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
    }

    public function delete($id): bool{
        $file = fopen(self::FILE_PATH, 'r+b');
        $deleted = false;

        while (!feof($file)) {
            $pos = ftell($file);
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());

            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) {
                continue;
            }

            $user = $this->userMapper->toUser($registerBinary);
            if ($user && $user->getId() === $id && $user->getDeleted() == 0) {
                $user->setDeleted(1);
                fseek($file, $pos);
                fwrite($file, $this->userMapper->toRegister($user));
                $deleted = true;
                break;
            }
        }

        fclose($file);

        return $deleted;
    }


    public function update($p): bool{
        $file = fopen(self::FILE_PATH, 'r+b');
        $updated = false;

        while (!feof($file)) {
            $pos = ftell($file);
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());
            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) continue;

            $user = $this->userMapper->toUser($registerBinary);
            if ($user && $user->getId() === $p->getId()) {
                fseek($file, $pos);
                fwrite($file, $this->userMapper->toRegister($p));
                $updated = true;
                break;
            }
        }

        fclose($file);

        return $updated;
    }
    


    public function findById($id): object | null {
        $file = fopen(self::FILE_PATH, 'rb');

        while (!feof($file)) {
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());
            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()){
                continue;
            }

            $user = $this->userMapper->toUser($registerBinary);
            if ($user && $user->getId() === $id) {
                fclose($file);
                return $user;
            }
        }

        fclose($file);
        return null;
    }

    

    /**
     * Function to find the user by username
     */
    public function findByUsername($username): object | null {
        //dd(self::FILE_PATH, $username);
        $file = fopen(self::FILE_PATH, 'rb');

        while (!feof($file)) {
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());
            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) {
                continue;
            }

            $user = $this->userMapper->toUser($registerBinary);
            if ($user && $user->getName() === $username) {
                fclose($file);
                return $user;
            }
        }

        fclose($file);
        return null;
    }


    public function findAll(): array{
        $usersFile = [];
        $file = fopen(self::FILE_PATH, 'rb');

        while (!feof($file)) {
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());
            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) {
                continue;
            }
            $user = $this->userMapper->toUser($registerBinary);
            if ($user) { 
                $usersFile[] = $user;
            }
        }

        fclose($file);
        return $usersFile;
    }
        

    public function save($p): object | null {
        $p->setId($this->createId());
        
        $registerBinary = $this->userMapper->toRegister($p);
        file_put_contents(self::FILE_PATH, $registerBinary, FILE_APPEND);

        return $p;
    }


    /**
     * Function to generate an id for a user
     */
    public function createId(): int {
        $id = 1; 
        
        if (file_exists(self::FILE_PATH)) {
            $file = fopen(self::FILE_PATH, 'rb');
           
            while (!feof($file)) {
                $registerBinary = fread($file, $this->userMapper->getSizeRegister());
                
                if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) {
                    continue;
                }

                $user = $this->userMapper->toUser($registerBinary);

                if ($user && $user->getId()) {
                    $id = max($id, $user->getId() + 1);
                }
            }

            fclose($file);
        }
        
        return $id;
    }




}
