<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practice15Controller extends Controller
{
    public function showForm(Request $request) {

        $name = session()->get('name');
        $age = session()->get('age');
        $likes = session()->get('likes');

        return view('practice15', compact('name', 'age', 'likes'));
    }

    public function handleForm(Request $request)
    {
        $nameSession = session()->get('name', '');
        $ageSession = session()->get('age', '');
        $likesSession = session()->get('likes', '');

        $nameUpdate = $request->get('name', $nameSession);
        $ageUpdate = $request->get('age', $ageSession);
        $likesUpdate = $request->get('likes', $likesSession);

        $request->session()->put('name', $nameUpdate);
        $request->session()->put('age', $ageUpdate);
        $request->session()->put('likes', $likesUpdate);

        return redirect('practice15')->with('success', 'Updated correctly.');
    }
}
