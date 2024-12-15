<?php

use App\Http\Controllers\AuthApiController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);

Route::apiResource('peliculas', AuthApiController::class)->middleware('auth:api')->except('destroy');
Route::apiResource('actor', AuthApiController::class)->middleware('auth:api')->except('destroy');
Route::apiResource('director', AuthApiController::class)->middleware('auth:api')->except('destroy');
Route::apiResource('categorias', AuthApiController::class)->middleware('auth:api')->except('destroy');

