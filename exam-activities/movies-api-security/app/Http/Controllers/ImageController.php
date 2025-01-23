<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller{
    public function upload(Request $request) {
        if ($request->hasFile('file')) {
            $fichero = $request->file('file');
            $nombre = $fichero->getClientOriginalName();
            $path = $fichero->storeAs($nombre);

            return response()->json([
                'path' => $path
            ], 200);
        }

        return response()->json([
            'message' => 'No se encontró ninguna imagen.',
        ], 400);
    }
}
