<?php

use App\Http\Controllers\AlumnoRESTController;
use App\Http\Controllers\AsignaturaRESTController;
use App\Http\Controllers\AuthApiController;
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


Route::apiResource('alumnos', AlumnoRESTController::class)->except(['destroy'])->middleware('auth:api');;

Route::prefix('alumnos')->group(function (){
    Route::get('alumnos', [AlumnoRESTController::class, 'index'])->middleware('auth:api');;
    Route::delete('alumnos/{alumno}', [AlumnoRESTController::class, 'destroy'])->middleware('auth:api');;
});

Route::apiResource('asignaturas', AsignaturaRESTController::class);

Route::prefix('asignaturas')->group(function (){
    Route::get('/', [AsignaturaRESTController::class, 'index']);
});


Route::apiResource('matriculas', MatriculaRESTController::class)->middleware('auth:api');
Route::prefix('matriculas')->group(function (){
    Route::get('/', [MatriculaRESTController::class, 'index'])->middleware('auth:api');
});

Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);
