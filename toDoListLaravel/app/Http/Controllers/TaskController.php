<?php

namespace App\Http\Controllers;
use App\Models\task;
use App\Models\User;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    function getUser(Request $request){
        $id = $request->input(key: 'id');
        return User::join('tasks', 'Users.task_id', 'task_id')
        //here we select which columns we want from the table
        ->select('users.*','tasks.title as title','tasks.description as description')
        ->where('users.id', $id)
        ->get();
    }


    function getUsers(){        
        $read = User::join('tasks', 'Users.task_id', 'task_id')->get();
        if($read){
            //response is taken as an array
            return response ([
                'message'=>'Success',
                'tasks'=> $read

            ]);
        }else{
            return response([
                'message' => 'failed',
                'tasks'=> 'no tasks available'
            ]);
        }
     
    }



    function createTask(Request $request){
        $request -> validate(
            [
            'title'=>'required',
            'description'=>'required',
            'user_id'=>'required'
            ]
            );
            $newTask = task::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'user_id'=>$request->user_id,

            ]);
            $newTask = task::find($newTask->id);
            if($newTask) {
                return response ([
                    'message'=>'success',
                    'name'=> $newTask
                ]);
            }else{
                return response([
                    'message'=> 'success',
                    'name'=> 'task  not created'
                ]);
            };
    }
    function readOneTask(Request $request){
        $request->validate([
            'id'=> 'required'
        ]);
        $findTask = task::find($request->id);
        if($findTask){
            return response ([
                'message'=>'success',
                'tasks'=> $findTask
            ]);
        }else{
            return response([
                'message' => 'failed',
                'tasks'=> 'this task does not exist'
            ]);
        }
    }
    function readAllTasks() {
        $allTasks = task::all();
        //checks whether the tasks exist or not
        if($allTasks){
            //response is taken as an array
            return response ([
                'message'=>'Success',
                'tasks'=> $allTasks

            ]);
        }else{
            return response([
                'message' => 'failed',
                'tasks'=> 'no task available'
            ]);
        }
    }
}
