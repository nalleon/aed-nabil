<?php
namespace App\DAO;

use App\DAO\Interface\ICrud;
use App\Models\UserMapper;

class UserFileDAO implements ICrud {

    private $filePath;
    private $userMapper;

    public function __construct($filePath) {
        $this->userMapper = new UserMapper();
        $this->filePath = $filePath;
    }

    public function delete($id): bool{
        $file = fopen($this->filePath, 'r+b');
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
        $file = fopen($this->filePath, 'r+b');
        $updated = false;

        while (!feof($file)) {
            $pos = ftell($file);
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());
            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) continue;

            $usuario = $this->userMapper->toUser($registerBinary);
            if ($usuario && $usuario->getId() === $p->getId()) {
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
        $file = fopen($this->filePath, 'rb');

        while (!feof($file)) {
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());
            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) continue;

            $usuario = $this->userMapper->toUser($registerBinary);
            if ($usuario && $usuario->getId() === $id) {
                fclose($file);
                return $usuario;
            }
        }

        fclose($file);
        return null;
    }


    public function findAll(): array{
        $usersFile = [];
        $file = fopen($this->filePath, 'rb');

        while (!feof($file)) {
            $registerBinary = fread($file, $this->userMapper->getSizeRegister());
            if (strlen($registerBinary) < $this->userMapper->getSizeRegister()) continue;

            $usuario = $this->userMapper->toUser($registerBinary);
            if ($usuario) { 
                $usersFile[] = $usuario;
            }
        }

        fclose($file);
        return $usersFile;
    }
        

    public function save($p): object | null {
        $registerBinary = $this->userMapper->toRegister($p);
        file_put_contents($this->filePath, $registerBinary, FILE_APPEND);

        return $p;
    }





}
