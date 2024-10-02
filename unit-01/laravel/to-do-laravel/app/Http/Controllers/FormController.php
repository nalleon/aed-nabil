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

    public function createTask(Request $request){
            $todolist = session()->get('todolist', []);

            $subject = $request->input('subject')??null;
            $id = count($todolist) + 1;
            $description=$request->input('description')??null;
            $finished = $request->input('finished') === 'Closed' ? true : false; 

            $newTask = new Task($subject, $id, $description, $finished);
            $todolist[] = $newTask;
    
            session()->put('todolist', $todolist); 

        return redirect('/');
    }

    public function updateForm(Request $request){
        $todolist = session()->get('todolist', []);

        $subject = $request->input('subject');
        $id = $request->input('id');
        $description=$request->input('description');
        $finished = $request->input('finished') === 'Closed' ? true : false; // important to declare

        foreach($todolist as $key => $item){
            if($item->getId() == $id){
                $item->setSubject($subject);
                $item->setDescription($description);
                $item->setFinished($finished);
                $todolist[$key] = $item;
                break;
            }
        }

        session()->put('todolist', $todolist);
        return redirect('/');
    }


    public function deleteTask(Request $request){
        $todolist = session()->get('todolist', []);
        $id = $request->input('id');

        foreach($todolist as $key => $item){
            if($item->getId() == $id){
                unset($todolist[$key]);
                break;
            }
        }

        session()->put('todolist', array_values($todolist));
        return redirect('/');
    }


}
