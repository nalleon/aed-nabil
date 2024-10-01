<?php

namespace App\Http\Controllers;
use App\Models\Task;

use Illuminate\Http\Request;
// flush and regenerate always
class FormController extends Controller
{
    public function show(){
        $todolist = session()->get('todolist');
    
        if (!isset($todolist)) {
            $todolist = [];
            $todolist[] = new Task('Task 1', 23, 'Description 1', false);
            $todolist[] = new Task('Task 2', 24, 'Description 2', true);
            session()->put('todolist', $todolist);
        }
    
        return view('startpage', compact('todolist'));
    }
    

    public function getTask(Request $request){
        $id = $request->input('id');

        $todolist = session()->get('todolist');
        $auxTask = null;


        foreach ($todolist as $item) {
            if($item->getId() == $id){
                $auxTask = $item;
                break;
            }

        }

        return view('tasks', compact('auxTask'));
    }
}
