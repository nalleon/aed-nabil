<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice18Controller extends Controller
{
    public function readFile(Request $request) {
        $file = $request->myfile;

        $content = [];

        $fileOriginalName = $file->getClientOriginalName();


        $path =$file->storeAs("/", $fileOriginalName);

        if (($open = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $content[] = $data;
            }
            fclose($open);
        }

        return redirect('/practice18', compact('content'));
    }
}
