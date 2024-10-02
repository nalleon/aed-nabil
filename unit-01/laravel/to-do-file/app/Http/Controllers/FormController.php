<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Storage\App;

use Illuminate\Http\Request;
// flush and regenerate always
class FormController extends Controller
{

    /**
     * Read file
     */
    public function getAllTasks(){
        $filePath = storage_path('app/tasks.csv');

        if(!file_exists($filePath)){
            return redirect()->route('startpage');
        }

        $tasks = [];


        if(($open = fopen($filePath, 'r') )!== false){
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if(count($data) == 4){
                    $tasks[] = new Task($data[0], 
                                        $data[1], 
                                        $data[2],
                                        $data[3] === 'Closed'? true : false);
            
                }                    
            }
            fclose($open);
            return view('startpage', compact('tasks'));
        }
    }
        
    /**
     * Get specific file 
     */

    public function getTask(Request $request){

        $id = $request->input('id');

        $filePath = storage_path('app/tasks.csv');

        if(!file_exists($filePath)){
            return redirect('/');
        }

        $auxTask = null;

        if(($open = fopen($filePath, 'r') )!== false){
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if($data[1] == $id){
                    $auxTask =  new Task(
                                $data[0], 
                                $data[1], 
                                $data[2],
                                $data[3] === 'Closed'? true : false);
                    break;
                }                    

            }

            fclose($open);
            return view('tasks', compact('auxTask'));
        }
    }

    /**
     * Create a new Task
     */

    public function createTask(Request $request){
            $filePath = storage_path('app/tasks.csv');

            $subject = $request->input('subject')??null;
            $id = $this->getId($filePath);
            $description=$request->input('description')??null;
            $finished = $request->input('finished') === 'Closed' ? true : false; 

            $newTask = new Task($subject, $id, $description, $finished);

            $open = fopen($filePath, 'a');
            if($open){
                fputcsv($open,[
                            $newTask->getSubject(),
                            $newTask->getId(),
                            $newTask->getDescription(),
                            $newTask->getFinished() ? 'Closed' : 'Open'
                        ]);
                fclose($open);
            }
    
        return redirect('/');
    }

    public function getId($filePath){
        if(file_exists($filePath)){
            $open = fopen($filePath, 'r');
            $id = 1;
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if(isset($data[1])){
                    $actualId = (int)$data[1];
                }
                $id = max($id, $actualId);
            }
            fclose($open);
            return $id+1;
        }
        
        return 1;
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
