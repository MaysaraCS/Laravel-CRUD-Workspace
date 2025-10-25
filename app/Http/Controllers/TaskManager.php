<?php

namespace App\Http\Controllers;
use App\Models\Tasks; 


use Illuminate\Http\Request;

class TaskManager extends Controller
{
    function listTask(){
        $tasks = Tasks::all();
        return view("welcome", compact('tasks'));
    }
    function addTask(){
        return view('tasks.addTask');
    }
    function addTaskPost(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'deadline'=>'required',
        ]);
        $task = new Tasks();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;

        if($task->save()){
            //return redirect(route("tasks.listTask"))
            return redirect(route("home"))
                ->with("success", "Task added successfully");
        }
        return redirect(route("tasks.addTask"))
                ->with("error", "Task Not Added");
    }
}
