<?php

use App\Http\Controllers\AlumnoRESTController;
use App\Http\Controllers\AsignaturaRESTController;
use App\Http\Controllers\MatriculaRESTController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('tasks', 'TasksRESTController');

//Route::get('alumnos', [AlumnoRESTController::class, 'index']);


Route::apiResource('alumnos', AlumnoRESTController::class);

Route::prefix('')->group(function (){
    Route::get('alumnos', [AlumnoRESTController::class, 'index']);
    Route::delete();
});


Route::apiResource('matriculas', MatriculaRESTController::class);

Route::prefix('asignaturas')->group(function (){
    Route::get('/', [AsignaturaRESTController::class, 'index']);
    Route::delete();
});


Route::apiResource('asignaturas', AsignaturaRESTController::class);

