<?php

use App\DAO\RolDAO;
use App\Http\Controllers\ConstruccionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsuarioController;
use App\Models\Rol;
use Illuminate\Support\Facades\Route;

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

// Register and login routes
Route::get('/', function (){
    return view('register');
})->name('registerView');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', function (){
    return view('login');
})->name('loginView');

Route::post('/login', [LoginController::class, 'loginUser'])->name('login');