<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Practice06Controller;
use App\Http\Controllers\Practice08Controller;
use App\Http\Controllers\Practice09Controller;
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

Route::get('/practice06/{dni}',[Practice06Controller::class, 'searchByDNI']);
Route::get('/practice08/findAll',[Practice08Controller::class, 'findAll']);
Route::get('/practice09',[Practice09Controller::class, 'findByDate']);
Route::get('/practice10',[Practice09Controller::class, 'find']);
