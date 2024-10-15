<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TextEditorController;
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
})->name('login');

Route::post('/login', [LoginController::class, 'createUser']);


Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');

/**
 * Text editor
 */

Route::get('/text-editor', function () {
    return view('text-editor');
});

Route::post('/write-text', [TextEditorController::class, 'writeText']);

// Show directories files of the user (private)
Route::get('directory-files/{directory}', [TextEditorController::class, 'showDirectoryFiles']);

// Show public files of the user (public)
Route::get('directory-public-files/{directory}', [TextEditorController::class, 'showPublicDirectoryFiles']);
