<?php

use App\Http\Controllers\ListarProductos;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Practice04Controller;
use App\Http\Controllers\Practice07Controller;
use App\Http\Controllers\Practice08Controller;
use App\Http\Controllers\Practice10Controller;
use App\Http\Controllers\Practice11Controller;
use App\Http\Controllers\Practice12Controller;
use App\Http\Controllers\ToDoTaskController;

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
    echo "Under construction";
    die();
});

Route::post('/pruebita', function () {
    echo "se ha ejecutado peticion a /pruebita";
    die();
});

Route::any('/relatos/{numero}', function ($numero) {
    echo "peticion recibido para el parametro: $numero";
    die();
})-> where('numero', '[0-9]+');

Route::get('/hola', [PruebaController::class, 'saludar']);


Route::get('/', function (){
    echo "Página raíz de nuestra aplicación";
});
*/

//Route::get('/', [Practice04Controller::class, 'controllerResponse']);


Route::get('/formulario', function(){
    return view('formaleatorios');
});


Route::get('/procesarformulario', [PruebaController::class, 'procesarform']);


Route::any('/', [ListarProductos::class, 'index']);

Route::any('/practice07', [Practice07Controller::class, 'primeNums']);



Route::get('/practice08', [Practice08Controller::class, 'date']);

Route::get('/practice09', function(){
    return view('practice09');
});

Route::get('/practice10', [Practice10Controller::class, 'rndNum']);

//Route::get('/practice11', [Practice10Controller::class, 'rndNum']);
Route::get('/practice11', function() {
    return view('practice11');
});


Route::get('/processwords', [Practice11Controller::class, 'processWords']);

Route::get('/practice12', [Practice12Controller::class, 'showImgs']);

/**
 * Extra exercise "To do: Task list"
 */
Route::get('/', [ToDoTaskController::class, 'main']);
Route::post('/', [ToDoTaskController::class, 'store']);
//Route::delete('/{id}', [ToDoTaskController::class, 'destroy'])->name('task.destroy');