<?php

use App\DAO\RolDAO;
use App\Http\Controllers\ConstruccionController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\UsuarioController;
use App\Models\Rol;
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


Route::get("/nuevorol", function (){
    $rolDAO = new RolDAO();
    $rol = new Rol();
    $rol->setNombre("prueba". rand(1,100));
    $resultado = $rolDAO->save($rol);
    dd($resultado);
});


Route::get("/allroles", function () {
    $rolDAO = new RolDAO();
    $roles = $rolDAO->findAll();
    dd($roles);
});


Route::get("/editrol", function () {
    $rolDAO = new RolDAO();
    $rol = (new Rol())
    ->setId(3)
    ->setNombre("modificado");
    $ok = $rolDAO->update($rol);
    if( $ok){
        echo "Rol modificado con éxito";
    }
});


Route::get("/borrarol", function () {
    $rolDAO = new RolDAO();

    $ok = $rolDAO->delete(3);
    if ($ok) {
        echo "rol borrado";
    }
});

