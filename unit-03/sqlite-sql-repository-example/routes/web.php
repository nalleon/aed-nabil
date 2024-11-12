<?php

use App\Models\Persona;
use App\Repository\PersonaRepository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get("/find/{id}", function($id){
    $personaRepository = new PersonaRepository();
    $persona = $personaRepository->findById($id);
    $datos = $persona->id .";" . $persona->nombre . ";" . $persona->edad;
    echo $datos;
});


Route::get("/grabar", function(){
    $personaRepository = new PersonaRepository();
    $persona = new Persona();
    $persona->nombre = "nino".rand(1,2000);
    $persona->edad = rand(20,100);
    $res = $personaRepository->save($persona);
    $datos = $res->id .";" . $res->nombre . ";" . $res->edad;
    echo $datos;
});


Route::get('/', function () {
    return view('welcome');
});
