<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

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
    return view('welcome');
});

// Route::get('/documents/{fileId}/edit', [DocumentController::class, 'openDocument'])->name('documents.edit');
Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
Route::get('documents/edit/{fileName}', [DocumentController::class, 'edit'])->name('documents.edit');
