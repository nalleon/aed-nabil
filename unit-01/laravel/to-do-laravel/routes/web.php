<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
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

// get
Route::get('/', [FormController::class, 'show']);

// post
Route::post('/task/create', [FormController::class, 'createTask']);

// put
//Route::post('/task', [FormController::class, 'postTask']);
//Route::post('/task/update', [FormController::class, 'updateForm']);

