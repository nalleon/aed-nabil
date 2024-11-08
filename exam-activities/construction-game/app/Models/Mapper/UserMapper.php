<?php

namespace App\Models\Mapper;
use App\Models\UserBBDD;
use Exception;
/**
 * @author Nabil L. A.
 */
class UserMapper {

    private const sizeUTF8 = 4;

    private const sizeName = 30 * self::sizeUTF8;
    private const sizePassword = 30 * self::sizeUTF8;
    private const sizeRol = 20 * self::sizeUTF8;
    private const sizeId = 4;

    private const bytesName = self::sizeName * self::sizeUTF8;
    private const bytesPassword = self::sizePassword * self::sizeUTF8;
    private const bytesRol = self::sizeRol * self::sizeUTF8;



    /**
     * Function to get the size of the register
     */
    public function getSizeRegister() {
        return self::sizeId + self::bytesName + self::bytesPassword + self::bytesRol;
    }

    /**
     * Function to convert into UTF-8
     */
    public function getUTF8($textToUTF8) {
        if (!mb_check_encoding($textToUTF8, 'UTF-8')) {
            $textToUTF8 = mb_convert_encoding($textToUTF8, 'UTF-8');
        }
        return $textToUTF8;
    }

    /**
     * Function to transform a User object into a register
     */
    public function toRegister(UserBBDD $userBBDD) {
        $sizeCadena0 = 100;
        $strZero = str_repeat("\0", $sizeCadena0);

        $name = $this->getUTF8($userBBDD->getName());
        $name = mb_substr($name . $strZero, 0, self::sizeName);

        $password = $this->getUTF8($userBBDD->getPassword());
        $password = mb_substr($password . $strZero, 0, self::sizePassword);

        $rol = $this->getUTF8($userBBDD->getRol());
        $rol = mb_substr($rol . $strZero, 0, self::sizeRol);

        $id = $userBBDD->getId();

        $registro = pack(
            'ia' . self::bytesName . 'a' . self::bytesPassword . 'a' . self::bytesRol,
            $id,
            $name,
            $password,
            $rol
        );
        return $registro;
    }

    /**
     * Function to transform a register from file to a User object
     */
    public function toUser($binary) {
        try {
            $datos = unpack('iid/a' . self::bytesName .
            'name/a' . self::bytesPassword . 'password/a' . self::bytesRol .
            'rol', $binary);
        } catch (Exception $e) {
            return null;
        }

        $userBBDD = new UserBBDD();
        $userBBDD->setId($datos['id']);
        $userBBDD->setName(trim($datos['name']));
        $userBBDD->setPassword(trim($datos['password']));
        $userBBDD->setRol(trim($datos['rol']));


        return $userBBDD;
    }

}
