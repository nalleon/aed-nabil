<?php

use App\Http\Controllers\AuthApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::get('/email/verify/{usuariorecibido}/{hash}', function(Request $request, User $usuariorecibido, $hash) {
if($usuariorecibido){
if (!hash_equals((string) $hash, sha1($usuariorecibido->getEmailForVerification()))) {
return response()->json(['message' => 'El enlace de verificación no es válido'], 403);
}
if ($usuariorecibido->hasVerifiedEmail()) {
return response()->json(['message' => 'El email ya está verificado']);
}
$usuariorecibido->markEmailAsVerified();
return response()->json(['message' => 'Email verificado correctamente']);
}else{
return response()->json(['message' => 'El usuario no existe'], 404);
}
})->middleware(['signed'])->name('api.verificarcorreo');


Route::middleware('auth:api')->group(function () {
    Route::apiResource('/v2/users', 'App\Http\Controllers\UserRESTControllerV2');
    Route::apiResource('/v3/users', 'App\Http\Controllers\UserRESTControllerV3')->middleware('roladmin');
});

