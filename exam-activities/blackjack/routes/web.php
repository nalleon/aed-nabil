<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GameController;
use App\Http\Controllers\LoginController;


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


/**
 * Login
 */
Route::get('/', function (){
    return view('login');
});

Route::post('/login', [LoginController::class, 'createUser']);


/**
 * Game
 */

Route::get('/blackjack', function () {
    return view('blackjack');
});

Route::post('/player-action', [GameController::class, 'getActions']);

