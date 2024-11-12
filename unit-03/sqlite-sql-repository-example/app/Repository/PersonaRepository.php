<?php

namespace App\Repository;

use App\Models\Persona;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PersonaRepository
{
        public function __construct(){}
        public function save(Persona $persona){

            $resultado = null;
            try{
                $persona->setConnection("mysql")->save();
                $persona->refresh();
                $resultado = $persona;
                $personaSqlite = new Persona();
                $personaSqlite->id = $persona->id;
                $personaSqlite->nombre = $persona->nombre;
                $personaSqlite->edad = $persona->edad;
                $personaSqlite->setConnection("sqlite")->save();
            }catch(Exception $e){
                echo $e->getMessage();
            }
            return $resultado;

        }

        public function findById(int $id){
            $persona = null;
            DB::connection()->enableQueryLog();
            $persona = Persona::find(1);
            $lastQuery = DB::getQueryLog();
            dd($lastQuery);

            try{
                $persona = Persona::on("mysql")->where("id", $id)->first();
            }catch(Exception $e){
                echo $e->getMessage();
                $persona = Persona::on("sqlite")->where("id", $id)->first();
            }


            return $persona;

        }
}
