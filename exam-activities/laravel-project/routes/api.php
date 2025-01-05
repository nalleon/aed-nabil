<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\CategoryRESTController;
use App\Http\Controllers\MovieRESTController;
use App\Models\Category;
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
    Route::delete('/movies/{movie}', [MovieRESTController::class, 'destroy'])->middleware('roleAdmin');
});


/**
 * Public categories routes
 */

Route::get('/categories', [CategoryRESTController::class, 'index']);
Route::get('/categories/{category}', [CategoryRESTController::class, 'show']);


/**
 * Private categories routes
 */

Route::middleware('auth:api')->group(function () {
    Route::post('/categories', [MovieRESTController::class, 'store']);
    Route::put('/categories/{category}', [MovieRESTController::class, 'update']);
    Route::delete('/categories/{category}', [MovieRESTController::class, 'destroy'])->middleware('roleAdmin');
});
