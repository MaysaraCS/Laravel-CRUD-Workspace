<?php

namespace App\Http\Controllers;
use App\Models\Tasks; 


use Illuminate\Http\Request;

class TaskManager extends Controller
{
    function listTask(){
        $tasks = Tasks::where("user_id", auth()->user()->id)->where("status", NULL)->paginate(5);
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
        $task->user_id = auth()->user()->id;

        if($task->save()){
            //return redirect(route("tasks.listTask"))
            return redirect(route("home"))
                ->with("success", "Task added successfully");
        }
        return redirect(route("tasks.addTask"))
                ->with("error", "Task Not Added");
    }
    function updateTaskStatus($id){
        if(Tasks::where("user_id", auth()->user()->id)->where('id', $id)->update(['status' => 'completed'])){
            return redirect(route("home"))->with("success" , "task completed");
        }
        return redirect(route("home"))->with("error" , "error occurred while updating , try again");
    }
    function deleteTask($id){
        if(Tasks::where("user_id", auth()->user()->id)->where('id', $id)->delete()){
            return redirect(route("home"))->with("success" , "task deleted");
        }
        return redirect(route("home"))->with("error" , "error occurred while deleting , try again");
    }
}
