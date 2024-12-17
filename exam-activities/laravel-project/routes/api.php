<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\MovieRESTController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


/**
 * Register/Login routes
 */
Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);

/**
 * Public movies routes
 */
Route::get('/movies', [MovieRESTController::class, 'index']);
Route::get('/movies/{movie}', [MovieRESTController::class, 'show']);


/**
 * Private movies routes
 */
Route::middleware('auth:api')->group(function () {
    Route::post('/movies', [MovieRESTController::class, 'store']);
    Route::put('/movies/{movie}', [MovieRESTController::class, 'update']);
});



