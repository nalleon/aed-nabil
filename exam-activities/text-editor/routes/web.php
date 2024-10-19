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

// Show the text editor page
Route::get('/text-editor', [TextEditorController::class, 'showTextEditor'])->name('startpage');

// Write files
Route::post('/write-text', [TextEditorController::class, 'writeText']);

// Show directories files 
Route::get('directory-files/{type}/{directory}', 
[TextEditorController::class, 'showDirectoryFiles'])->name('showDirectoryFiles');

// Edit the selected file
Route::any('/edit-file',  [TextEditorController::class, 'editFile'])->name('edit');

// Update the selected file
Route::post('/edit-file/update', [TextEditorController::class, 'updateFile']);
