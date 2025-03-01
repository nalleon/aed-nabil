<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\FigureController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// For users 
Route::get('/home', [BoardController::class, 'index'])->name('userhome');
Route::post('/home', [BoardController::class, 'createBoard'])->name('createBoard');
Route::get('/home/edit/{id}/', [BoardController::class, 'editBoard'])->name('editBoard');
Route::post('/home/edit/{id}/', [BoardController::class, 'updateBoard'])->name('updateBoard');
Route::post('/home/delete/{id}/', [BoardController::class, 'deleteBoard'])->name('deleteBoard');

//For administrators
Route::get('/admin/home', [AdminController::class, 'index'])->name('adminhome');

// Admin - Manage users
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('manageusers');
Route::get('/admin/users/edit/{id}', [AdminController::class, 'editUser'])->name('edituser');
Route::post('/admin/users/update/{id}', [AdminController::class, 'updateUser'])->name('updateuser');
Route::post('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('deleteuser');

// Admin - Manage images
Route::get('/admin/figureupload', [FigureController::class, 'showFigures'])->name('figureupload');
Route::post('/admin/figureupload', [FigureController::class, 'uploadImg'])->name('figureuploadpost');
