<?php

namespace App\Http\Controllers;

use App\DAO\BoardDAO;
use App\DAO\FigureBoardDAO;
use App\DAO\FigureDAO;
use App\DAO\UserBBDDDAO;
use App\DAO\UserFileDAO;
use App\Models\Board;
use App\Models\FigureBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{


    protected $boardDAO;
    protected $figureBoardDAO;
    protected $figureDAO;
    
    protected $userFileDAO;
    protected $userDAO;

    public function __construct(){
        $this->boardDAO = new BoardDAO();
        $this->figureBoardDAO = new FigureBoardDAO();
        $this->figureDAO = new FigureDAO();
        $this->userFileDAO = new UserFileDAO();
        $this->userDAO = new UserBBDDDAO();
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

        $boards = [];
        
        if($this->checkIfUserExistsInBBDD($user) !== null){
            $userId =$this->checkIfUserExistsInBBDD($user);
            $boards = $this->boardDAO->findAllBoardsPerUser($userId);    
            return view('home', compact('boards'));
        }


        return view('home', compact('boards'));
    }

    /**
     * Function to check if the user exists in the bbdd 
     */
    public function checkIfUserExistsInBBDD($user){
        $usersFile = $this->userFileDAO->findAll();
        $usersBBDD = $this->userDAO->findAll();
        
        foreach ($usersFile as $userFile){
            foreach ($usersBBDD as $userBBDD){
                if($userFile->getName() == $userBBDD->getName()){
                    if ($userBBDD->getName() === $user->getName()){
                        $id = $userBBDD->getId();
                        return $id;
                    }
                }
            }
        }
        return null;
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

        $figures = $this->figureBoardDAO->getFiguresByBoard($id);

        $allFiguresOptions = $this->figureDAO->findAll();

        return view('userboard', compact('board', 'figures', 'allFiguresOptions'));
    }


    public function updateBoard(Request $request, $id) {
        $this->checkUser();

        $board = $this->boardDAO->findById($id);
        $allFiguresOptions = $this->figureDAO->findAll();
        $figures = $this->figureBoardDAO->getFiguresByBoard($id);

        $figureToAddId = $request->input('figureChosen');

        if ($figureToAddId === null) {
            session()->put('message', 'Select the figure to add');
            return view('userboard', compact('board', 'figures', 'allFiguresOptions'));
        }

        $positionToEdit = $request->input('positionToEdit');

        if ($positionToEdit === null) {
            session()->put('message', 'Select the positions to change');
            return view('userboard', compact('board', 'figures', 'allFiguresOptions'));
        }


        $this->figureBoardDAO->updateBoardFigures($positionToEdit,$id, $figureToAddId);

        $figures = $this->figureBoardDAO->getFiguresByBoard($id);

        $board = $this->boardDAO->findById($id);
        
        session()->forget('message');

        return view('userboard', compact('board', 'figures', 'allFiguresOptions'));
    }


}
