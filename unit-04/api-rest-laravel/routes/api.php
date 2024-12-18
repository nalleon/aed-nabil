<?php

use App\Http\Controllers\AlumnoRESTController;
use App\Http\Controllers\AsignaturaRESTController;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MatriculaRESTController;

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


Route::apiResource('alumnos', AlumnoRESTController::class)->except(['destroy'])->middleware('auth:api');;

Route::prefix('alumnos')->group(function (){
    Route::get('/', [AlumnoRESTController::class, 'index'])->middleware('auth:api');;
    Route::delete('/{alumno}', [AlumnoRESTController::class, 'destroy'])->middleware('auth:api', 'roladmin');;
});

Route::apiResource('asignaturas', AsignaturaRESTController::class);

Route::prefix('asignaturas')->group(function (){
    Route::get('/', [AsignaturaRESTController::class, 'index']);
});


Route::apiResource('matriculas', MatriculaRESTController::class)->except(['destroy'])->middleware('auth:api');
Route::prefix('matriculas')->group(function (){
    Route::get('/', [MatriculaRESTController::class, 'index'])->middleware('auth:api');
    Route::delete('/{matricula}', [MatriculaRESTController::class, 'destroy'])->middleware('auth:api', 'roladmin');
});

/**
 * Register/login routes
 */
Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);


Route::post('/upload', [ImageController::class, 'upload']);
