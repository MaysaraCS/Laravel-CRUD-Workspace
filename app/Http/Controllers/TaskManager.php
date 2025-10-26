<?php

namespace App\Http\Controllers;
use App\Models\Tasks;
use App\Models\WorkSpace;
use App\Http\Requests\StoreTaskRequest;
use Carbon\Carbon;


use Illuminate\Http\Request;

class TaskManager extends Controller
{
    function listTask(){
        if (auth()->check()) {
            $workspaces = WorkSpace::where("user_id", auth()->user()->id)->get();
            return view("welcome", compact('workspaces'));
        } else {
            return redirect()->route('register');
        }
    }
    function addTask($workspaceId){
        $workspace = WorkSpace::where('id', $workspaceId)->where('user_id', auth()->id())->firstOrFail();
        return view('tasks.addTask', compact('workspace'));
    }
    function addTaskPost(StoreTaskRequest $request, $workspaceId){
        $workspace = WorkSpace::where('id', $workspaceId)->where('user_id', auth()->id())->firstOrFail();
        $task = new Tasks();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->user_id = auth()->user()->id;
        $task->workspace_id = $workspace->id;

        if($task->save()){
            return redirect(route("workspaces.show", $workspace->id))
                ->with("success", "Task added successfully");
        }
        return redirect(route("tasks.addTask", $workspace->id))
                ->with("error", "Task Not Added");
    }
    function updateTaskStatus($id){
        $task = Tasks::where("user_id", auth()->user()->id)->where('id', $id)->firstOrFail();
        if($task->update(['status' => 'completed'])){
            return redirect()->back()->with("success" , "task completed");
        }
        return redirect()->back()->with("error" , "error occurred while updating , try again");
    }
    function deleteTask($id){
        $task = Tasks::where("user_id", auth()->user()->id)->where('id', $id)->firstOrFail();
        $workspaceId = $task->workspace_id;
        if($task->delete()){
            return redirect(route("workspaces.show", $workspaceId))->with("success" , "task deleted");
        }
        return redirect(route("workspaces.show", $workspaceId))->with("error" , "error occurred while deleting , try again");
    }
}
