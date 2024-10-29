<?php

namespace App\Http\Controllers;

use App\DAO\BoardDAO;
use App\DAO\FigureBoardDAO;
use App\DAO\FigureDAO;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{


    protected $boardDAO;
    protected $figureBoardDAO;

    public function __construct(){
        $this->boardDAO = new BoardDAO();
        $this->figureBoardDAO = new FigureBoardDAO();
        }

    /**
     * Method to check if the session has an user
     */
    public function checkUser(){
        if(!session()->has('user')){
            return redirect()->route('login')->send();
        }
    }


    public function index() {       
        $this->checkUser();

        $user = session()->get('user');
        $userId = $user[0];


        $boards = [];
        $boards = $this->boardDAO->findAllBoardsPerUser($userId);

        //dd($boards);
        return view('home', compact('boards'));
    }

    public function createBoard(Request $request) {
        $this->checkUser();

        $request->validate([
            'boardName' => 'required|string|max:255',
        ]);

       
       
        $user = session()->get('user');
        $userId = $user[0];

        
        $boardName = $request->input('boardName');
        $board = new Board();
        $board->setName($boardName);
        $board->setUserId($userId);
        $board->setContent("");
        $board->setDate(time());

        $savedBoard = $this->boardDAO->save($board);

        if ($savedBoard === null) {
            return redirect()->route('userhome')->with('message', 'Failed to create board');
        }

        return redirect()->route('userhome')->with('message', 'Board created successfully');
    }

    public function deleteBoard($id){
        $this->checkUser();
        $boardToDelete = $this->boardDAO->findById($id);
        $deleted = $this->boardDAO->delete($id);

        if (!$deleted) {
            return redirect()->route('userhome')->with('message', 'Board could not be deleted');
        }

        return redirect()->route('userhome')->with('message', 'Board ' . $boardToDelete->getName() . 'succesfully deleted!');
    }

    public function editBoard($id) {
        $this->checkUser();
        $board = $this->boardDAO->findById($id);

        if ($board === null) {
            return redirect()->route('userhome')->with('message', 'Board not found');
        }

        return view('userboard', compact('board'));
    }


}
