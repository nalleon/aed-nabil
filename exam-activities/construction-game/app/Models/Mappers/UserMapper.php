<?php

namespace App\Models;

use Exception;

class MapperPersona {



    private const sizeUTF8 = 4;
    private const sizeNombre = 30 * self::sizeUTF8; // 30 caracteres UTF-8 (4 bytes por carácter)
    private const sizeApellidos = 50 * self::sizeUTF8;
    private const sizeEdad = 4; // Entero de 4 bytes
    private const sizePeso = 4; // float
    private const sizeId = 4; // Entero de 4 bytes
    private const bytesApellidos = self::sizeApellidos * self::sizeUTF8;
    private const bytesNombre = self::sizeNombre * self::sizeUTF8;

    public function getSizeRegistro(){
        return self::sizeId + self::sizeEdad + self::sizePeso + self::bytesNombre + self::bytesApellidos;
    }

    function getUTF8($texto){
        if (!mb_check_encoding($texto, 'UTF-8')) {
            // Si no está en UTF-8, lo convertimos
            $texto = mb_convert_encoding($texto, 'UTF-8');
        }
        return $texto;
    }

    public function toRegistro(Persona $persona){

        // generamos una cadena de \0 muy grande para concatenar
        $sizeCadena0 = 100;
        $cadena_con_ceros = "";
        for($i=0; $i < $sizeCadena0; $i++)
            $cadena_con_ceros.= "\0";


        //garantizamos UTF-8
        $nombre = $this->getUTF8($persona->getNombre());

        // Cortamos la cadena para quedarnos con los primeros sizeNombre caracteres
        // usamos mb_substr porque es seguro respecto a utf-8
        $nombre = mb_substr($nombre.$cadena_con_ceros, 0, self::sizeNombre );

        $apellidos = $this->getUTF8($persona->getApellidos());
        $apellidos = mb_substr($apellidos.$cadena_con_ceros,0, self::sizeApellidos );


        $id = $persona->getId();
        $edad = $persona->getEdad();
        $peso = $persona->getPeso();

        $registro = pack(
            'ia'.self::bytesNombre.'a'.self::bytesApellidos.'if',
            $id,
            $nombre,
            $apellidos,
            $edad,
            $peso
        );

        //$copia  = $this->toPersona($registro);
        //var_dump($copia);

        return $registro;

    }


    public function toPersona($binario){
        try{
            $datos = unpack('iid/a'.self::bytesNombre.'nombre/a'.self::bytesApellidos.'apellidos/iedad/fpeso', $binario);
        }catch(Exception $e){
            //echo "Error: ".$e->getMessage();
            return null;
        }

        $persona = new Persona();
        $persona
            ->setId($datos['id'])
            ->setNombre(trim($datos['nombre']))
            ->setApellidos(trim($datos['apellidos']))
            ->setEdad($datos['edad'])
            ->setPeso(round($datos['peso'],2));

        return $persona;
    }

}
