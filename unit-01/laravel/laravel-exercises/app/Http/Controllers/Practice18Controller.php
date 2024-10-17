<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice18Controller extends Controller
{
    public function readFile(Request $request) {
        if (!$request->hasFile('myFile')) {
            return back()->withErrors(['myFile' => 'No se ha subido ningún archivo.']);
        }

      
        $file = $request->file('myFile');

        $content = [];

        $fileOriginalName = $file->getClientOriginalName();

        $path =$file->storeAs("/", $fileOriginalName);
        
        if (($open = fopen(storage_path('app/' . $path), "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $content[] = $data;
            }
            fclose($open);
        }

        return redirect('/practice18')->with('content', $content);
    }
}
