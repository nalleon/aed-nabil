<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListarProductos extends Controller
{
    public function index(Request $request) {
        if ($request->isMethod('GET')){
            echo "Ejecutando el controlador ListarProductos mediante get";
        } elseif ($request->isMethod('POST')) {
            echo "Ejecutando el controlador ListarProductos mediante POST";
        }
    }
}
