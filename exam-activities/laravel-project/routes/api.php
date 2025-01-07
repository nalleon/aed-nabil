<?php

use App\Http\Controllers\ActorRESTController;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\CategoryRESTController;
use App\Http\Controllers\DirectorRESTController;
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
    Route::post('/categories', [CategoryRESTController::class, 'store']);
    Route::put('/categories/{category}', [CategoryRESTController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryRESTController::class, 'destroy'])->middleware('roleAdmin');
});


/**
 * Public actors routes
 */

Route::get('/actors', [ActorRESTController::class, 'index']);
Route::get('/actors/{actor}', [ActorRESTController::class, 'show']);


/**
 * Private actors routes
*/
Route::middleware('auth:api')->group(function () {
    Route::post('/actors', [ActorRESTController::class, 'store']);
    Route::put('/actors/{actor}', [ActorRESTController::class, 'update']);
    Route::delete('/actors/{actor}', [ActorRESTController::class, 'destroy'])->middleware('roleAdmin');
});



/**
 * Public directors routes
 */

Route::get('/directors', [DirectorRESTController::class, 'index']);
Route::get('/directors/{director}', [DirectorRESTController::class, 'show']);

/**
 * Private directors routes
*/
Route::middleware('auth:api')->group(function () {
    Route::post('/directors', [DirectorRESTController::class, 'store']);
    Route::put('/directors/{director}', [DirectorRESTController::class, 'update']);
    Route::delete('/directors/{director}', [DirectorRESTController::class, 'destroy'])->middleware('roleAdmin');
});
