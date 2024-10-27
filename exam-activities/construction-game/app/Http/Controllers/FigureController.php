<?php

namespace App\Http\Controllers;

use App\DAO\FigureDAO;
use App\Models\Figure;
use Illuminate\Http\Request;

class FigureController extends Controller {

    protected $figureDAO;

    public function __construct(){
        $this->figureDAO = new FigureDAO();
    }

    public function checkUser(){
        if(!session()->has('user')){
            $user = session()->get('user');

            if($user->getRol()!= 'admin') {
                return redirect()->route('login')->send();
            }
        }
    }

    public function showFigures(){
        $this->checkUser();
        return view('figureupload');
    }

    public function uploadImg(Request $request){
        $this->checkUser();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $image = $request->file('image');

        $imageContent = file_get_contents($image->getRealPath());
        $mimeType = $image->getMimeType();

        $figure = new Figure();
        $figure->setImage($imageContent);
        $figure->setTypeImage($mimeType);

        $savedFigure = $this->figureDAO->save($figure);

        if ($savedFigure) {
            return redirect()->back()->with('message', 'Image succesfully uploaded!');
        } else {
            return redirect()->back()->with('message', 'Error while uploading the image.');
        }

        return view('uploadimg');
    }
}
