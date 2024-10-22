<?php

use App\DAO\RolDAO;
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

Route::get('/', function () {
    $rolDAO = new RolDAO();
    $roles = $rolDAO->findAll();
    print_r($roles);
    return view('welcome');
});
