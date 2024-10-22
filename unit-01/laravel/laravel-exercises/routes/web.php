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
use App\Http\Controllers\Practice13Controller;
use App\Http\Controllers\Practice15Controller;
use App\Http\Controllers\Practice16Controller;
use App\Http\Controllers\Practice17Controller;
use App\Http\Controllers\Practice18Controller;
use App\Http\Controllers\Practice19Controller;
use App\Http\Controllers\Practice20Controller;

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


Route::get('/practice13', [Practice13Controller::class, 'getColors']);
Route::post('/add-color', [Practice13Controller::class, 'addColor']);
Route::post('/delete-color/{id}', [Practice13Controller::class, 'deleteColor']);
//Route::post('/update-color/{id}', [Practice13Controller::class, 'updateColor']);


//practice17

/**
 * Practice 17: Crear un formulario que se introduzca un nombre y cree un directorio enstorage con ese nombre
 */

 Route::get('/practice17', function (){
    return view('/practice17');
 });

 Route::post('/create-directory', [Practice17Controller::class, 'createDirectory']);

/**
 * Practice 18: Crear un fichero con nombre y dirección de correo por fila ( en formato csv )
 * almacenado en Storage Leer el fichero y mostrarlo en pantall
 */

 Route::get('/practice18', function (){
    return view('/practice18');
 });

 Route::post('/read-file', [Practice18Controller::class, 'readFile']);

 /**
  * Una forma fácil de visualizar el token csrf es mediante: {{ csrf_token() }} 
  * Introducir en la práctica 12 ese código y comprobar que está activo.
  */
  

  // Practice 15
/**
 * Crear un formulario POST Con los datos de un posible usuario 
 * ( nombre, edad, gustos, etc ) En cada ejecución de este formulario se le muestra al
 *  usuario la información almacenada del usuario en session() Observar que si se envía el formulario
 *  sin rellenar algún campo, se mantendrá la información anterior respecto a ese campo
 */
 
Route::get('/practice15', [Practice15Controller::class, 'showForm']);

Route::post('practice15/update', [Practice15Controller::class, 'handleForm']);

// Pratcice 16

/**
 * Crear un fichero con nombre y dirección de correo por fila ( en formato csv )
 * almacenado en Storage Leer el fichero y mostrarlo en pantalla
 */

 Route::get('/practice16', [Practice16Controller::class, 'readCsv']);


 // Practice 19

 /**
  * Mostrar en una página una lista de ficheros de una carpeta en storage.
  * Cuando se pulse en el nombre del fichero se descargará
  */

Route::get('/practice19', [Practice19Controller::class, 'showFiles']);
Route::get('/practice19/download/{filename}', [Practice19Controller::class, 'downloadFile']);

// Practice 20

Route::get('/practice20', [Practice20Controller::class, 'showFiles']);
Route::get('/practice20/download/{filename}', [Practice20Controller::class, 'downloadFile']);
Route::post('/practice20/delete/{filename}', [Practice20Controller::class, 'deleteFile']);