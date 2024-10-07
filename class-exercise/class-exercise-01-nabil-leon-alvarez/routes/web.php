<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;

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
 * Create controller: php artisan make:controller  name.php
 * Create model: php artisan make:model  name.php
 */


//Route::get('/', [LoginController::class, 'main']);

Route::get('/', function (){
    return view('login');
});

Route::post('/login', [LoginController::class, 'createUser']);

Route::get('/main', [LoginController::class, 'getUser']);

Route::post('/writeMessage', [MessageController::class, 'writeMessage']);
