<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimeController extends Controller
{
    private function isPrime(int $num): bool{
        if ($num < 2) {
            return false; 
        }

        for ($i = 2; $i <= sqrt($num); $i++) {
            if ($num % $i === 0) {
                return false;
            }
        }

        return true; 
    }

    public function calculatePrimes($start, $end)
    {
        $primes = [];

        for ($i = $start; $i <= $end; $i++) {
            if ($this->isPrime($i)) {
                $primes[] = $i; 
            }
        }

        dd(response()->json($primes));

    }
}
