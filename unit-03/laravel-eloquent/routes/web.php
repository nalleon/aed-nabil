<?php

use App\Http\Controllers\Practice06Controller;
use App\Http\Controllers\Practice08Controller;
use App\Http\Controllers\Practice09Controller;
use App\Http\Controllers\Practice11Controller;
use App\Http\Controllers\Practice12Controller;
use App\Http\Controllers\Practice14Controller;
use App\Http\Controllers\Practice15Controller;
use App\Http\Controllers\Practice16Controller;
use App\Http\Controllers\Practice17Controller;
use App\Http\Controllers\Practice18Controller;
use App\Http\Controllers\Practice19Controller;
use App\Http\Controllers\Practice21Controller;
use App\Http\Controllers\Practice22Controller;
use App\Http\Controllers\ProfileController;
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
Route::get('/practice17',[Practice17Controller::class, 'createCurrency']);
Route::get('/practice17-modify',[Practice17Controller::class, 'updateCurrency']);
Route::get('/practice18',[Practice18Controller::class, 'index']);
Route::get('/practice19',[Practice19Controller::class, 'index']);
Route::post('/practice19/create',[Practice19Controller::class, 'createMoneda']);
Route::get('/practice21',[Practice21Controller::class, 'matriculas']);
Route::get('/practice211',[Practice21Controller::class, 'createAlumno']);
Route::get('/practice22',[Practice22Controller::class, 'showAlumnos'])->middleware('auth');
Route::get('/practice23', function () {
    dd('soy admin');
    })->middleware('auth', 'rolAdmin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
