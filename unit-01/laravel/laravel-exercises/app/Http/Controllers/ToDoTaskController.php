<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToDoTaskController extends Controller
{
    public function main() {
        return view('todortasks');
    }

    
}
