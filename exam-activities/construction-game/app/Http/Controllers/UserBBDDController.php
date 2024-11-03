<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserBBDDController extends Controller
{
    public function example(){
        $pdo = DB::getPdo();
        $st = $pdo->prepare("select * from usuarios");
        $st->execute();

        foreach( $st->fetchAll() as $fila){
            if( $fila["nombre"] == "root"){
                //print_r($fila);
                $clave = $fila["password"];
                echo " $clave <br>";
                


                if( password_verify("root", $clave)){
                    echo " la contraseña es root";
                }
                if( password_verify("1q2w3e4r", $clave)){
                    echo " la contraseña es 1q2w3e4r";
                }
            }
        }

        //si queremos generar una nueva clave:
        $nuevaClave = password_hash("unanuevaclave", PASSWORD_BCRYPT );
        echo "<br>Clave password_hash: $nuevaClave";

        //si usamos Hash::make y Hash::check
        $nuevaClave = Hash::make("unanuevaclave");
        echo "<br>Clave Hash::make:  $nuevaClave";

        if( Hash::check( "unanuevaclave",$nuevaClave)){
            echo "<br> las claves son coincidentes";
        }
        $pdo = null;

        die();
    }
}
