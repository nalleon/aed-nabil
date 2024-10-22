<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class Practice16Controller extends Controller
{
    public function readCsv (){
        $csvContent = Storage::get('users.csv');
        $rows = explode("\n", $csvContent);
        $data = [];

        foreach ($rows as $row) {
            $columns = explode(',', $row);
            $data[] = [
                'name' => $columns[0],
                'email' => $columns[1],
            ];
        }

        return view('practice16', compact('data'));
    }
}
