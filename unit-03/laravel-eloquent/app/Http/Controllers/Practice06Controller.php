<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Practice06Controller extends Controller{
    public function searchByDNI($dni){
        DB::connection()->enableQueryLog();
        $student = Alumno::find($dni);
        $lastQuery = DB::getQueryLog();
        dd($lastQuery);

        return view('Practice06', compact('student'));
    }
}
