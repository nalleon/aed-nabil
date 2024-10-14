<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TextEditor;
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
});

Route::post('/login', [LoginController::class, 'createUser']);


/**
 * Text editor
 */

Route::get('/text-editor', function () {
    return view('text-editor');
});

Route::post('/write-text', [TextEditor::class, 'writeText']);

//Route::post('/write-text', [TextEditor::class, 'testMethod']);

