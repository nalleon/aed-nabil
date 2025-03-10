<?php

namespace App\Http\Controllers;

use App\DAO\BoardDAO;
use App\DAO\FigureBoardDAO;
use App\DAO\FigureDAO;
use App\DAO\UserBBDDDAO;
use App\File\UserFileCrud;
use App\Models\Board;
use Exception;
use Illuminate\Http\Request;
/**
 * @author Nabil L. A.
 */
class BoardController extends Controller{

    protected $boardDAO;
    protected $figureBoardDAO;
    protected $figureDAO;
    
    protected $userFileCrud;
    protected $userDAO;

    /**
     * Default constructor
     */
    public function __construct(){
        $this->boardDAO = new BoardDAO();
        $this->figureBoardDAO = new FigureBoardDAO();
        $this->figureDAO = new FigureDAO();
        $this->userFileCrud = new UserFileCrud();
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

    /**
     * Function to show the home of the user logged in
     */
    public function index() {
        $this->checkUser();

        $user = session()->get('user');
    

        $boards = [];

        if($this->checkIfUserExistsInBBDD($user) !== null){
            $userId = $this->checkIfUserExistsInBBDD($user);
            $boards = $this->boardDAO->findAllBoardsPerUser($userId);    
            return view('home', compact('boards'));
        }

        return view('home', compact('boards'));
    }

    /**
     * Function to check if the user exists in the bbdd 
     */
    public function checkIfUserExistsInBBDD($user){
        $usersFile = null;
        $usersBBDD = null;

        try {
            $usersFile = $this->userFileCrud->findAll();
            $usersBBDD = $this->userDAO->findAll();
        } catch (Exception $e){
            return null;
        }

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

    /**
     * Function to create a new board for a user
     */
    public function createBoard(Request $request) {
        $this->checkUser();

        $request->validate([
            'boardName' => 'required|string|max:255',
        ]);

        $user = session()->get('user');
        //dd($user);
        $userId = $user->getId();

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

    /**
     * Function to delete the board of a user
     */
    public function deleteBoard($id){
        $this->checkUser();
        $boardToDelete = $this->boardDAO->findById($id);
        $deleted = $this->boardDAO->delete($id);

        if (!$deleted) {
            return redirect()->route('userhome')->with('message', 'Board could not be deleted');
        }

        return redirect()->route('userhome')->with('message', 'Board ' . $boardToDelete->getName() . 'succesfully deleted!');
    }

    /**
     * Function to select the board to edit
     */
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


    /**
     * Function to update the board selected
     */
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
