<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Practice06Controller;
use App\Http\Controllers\Practice08Controller;
use App\Http\Controllers\Practice09Controller;
use App\Http\Controllers\Practice11Controller;
use App\Http\Controllers\Practice12Controller;
use App\Http\Controllers\Practice14Controller;
use App\Http\Controllers\Practice15Controller;
use App\Http\Controllers\Practice16Controller;
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
Route::get('/practice11',[Practice11Controller::class, 'find1DAM']);
Route::get('/practice12',[Practice12Controller::class, 'create']);
Route::get('/practice13',[Practice12Controller::class, 'modify']);
Route::get('/practice14',[Practice14Controller::class, 'createHistoric' ]);
Route::get('/practice15',[Practice15Controller::class, 'createHistoric15']);
Route::get('/practice16',[Practice16Controller::class, 'createHistoric']);
