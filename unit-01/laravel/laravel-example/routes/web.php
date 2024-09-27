<?php

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

/**Route::get('/', function () {
    //echo "helloooooooo!";
    //die();

    return view('welcome');
});
 */


 Route::get('/', function () {
    echo "Under construction";
});

Route::post('/pruebita', function () {
    echo "Se ha ejecutado una petición POST a la dirección: /pruebita";
});

Route::any('/relatos/numeros/{num}', function ($num) {
    echo "Petición recivida para el parámetro: ". $num;
    exit();
})->where('num', '[0-9]+');

/**
 * Crear una ruta para el raíz: “/” En una primera implementación mostrará el mensaje:
 * “página raíz de nuestra aplicación” que se resolverá en el propio web.php
 *Haremos una segunda versión de esta actividad en la que redireccionará hacia el
 *controlador y la función pertinente y allí se mostrará un mensaje que indique
 *adicionalmente que se ha respondido desde el controlador
 */

Route::get('/', function (){
    echo "Página raíz de nuestra aplicación";
});

Route::get('/', 'HomeController@index')->name('home.controller');


