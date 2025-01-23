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
Route::post('/movies', [MovieRESTController::class, 'store']);
Route::put('/movies/{movie}', [MovieRESTController::class, 'update']);
Route::delete('/movies/{movie}', [MovieRESTController::class, 'destroy']);

/**
 * Public categories routes
 */

Route::get('/categories', [CategoryRESTController::class, 'index']);
Route::get('/categories/{category}', [CategoryRESTController::class, 'show']);


/**
 * Private categories routes
 */

Route::post('/categories', [CategoryRESTController::class, 'store']);
Route::put('/categories/{category}', [CategoryRESTController::class, 'update']);
Route::delete('/categories/{category}', [CategoryRESTController::class, 'destroy']);


/**
 * Public actors routes
 */

Route::get('/actors', [ActorRESTController::class, 'index']);
Route::get('/actors/{actor}', [ActorRESTController::class, 'show']);


/**
 * Private actors routes
*/
Route::post('/actors', [ActorRESTController::class, 'store']);
Route::put('/actors/{actor}', [ActorRESTController::class, 'update']);
Route::delete('/actors/{actor}', [ActorRESTController::class, 'destroy']);




/**
 * Public directors routes
 */

Route::get('/directors', [DirectorRESTController::class, 'index']);
Route::get('/directors/{director}', [DirectorRESTController::class, 'show']);


Route::post('/directors', [DirectorRESTController::class, 'store']);
Route::put('/directors/{director}', [DirectorRESTController::class, 'update']);
Route::delete('/directors/{director}', [DirectorRESTController::class, 'destroy']);

