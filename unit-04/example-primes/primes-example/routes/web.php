<?php

use App\Http\Controllers\PrimeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/calculate-primes/{start}/{end}', [PrimeController::class, 'calculatePrimes']);

?>