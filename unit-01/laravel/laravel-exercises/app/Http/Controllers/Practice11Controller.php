<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice11Controller extends Controller
{
    public function processWords(Request $request) {
        $words = explode(',',  $request->input('words')??null);

        return view('practice11result', [
            'words' => $words,
        ]);
    }
}
