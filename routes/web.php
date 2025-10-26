<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;
use App\Http\Controllers\WorkSpace;



Route::get('/', [TaskManager::class, "listTask"])
    ->name('home');

Route::get('/login', [AuthManager::class, 'login'])
    ->name('login');

Route::post('/login', [AuthManager::class, 'loginPost'])
    ->name('login.post');

Route::get('/logout', [AuthManager::class, 'logout'])
    ->name('logout');

Route::get('/register', [AuthManager::class, 'register'])
    ->name('register');

Route::post('/register', [AuthManager::class, 'registerPost'])
    ->name('register.post');

Route::middleware("auth")->group(function(){

    Route::get("workspaces/create", [WorkSpace::class,"create"])
        ->name("workspaces.create");

    Route::post("workspaces", [WorkSpace::class,"store"])
        ->name("workspaces.store");

    Route::get("workspaces/{id}", [WorkSpace::class,"show"])
        ->name("workspaces.show");

    Route::get("workspaces/{id}/edit", [WorkSpace::class,"edit"])
        ->name("workspaces.edit");

    Route::put("workspaces/{id}", [WorkSpace::class,"update"])
        ->name("workspaces.update");

    Route::delete("workspaces/{id}", [WorkSpace::class,"destroy"])
        ->name("workspaces.destroy");

    Route::get("workspaces/{workspaceId}/tasks/add", [TaskManager::class,"addTask"])
        ->name("tasks.addTask");

    Route::post("workspaces/{workspaceId}/tasks", [TaskManager::class,"addTaskPost"])
        ->name("tasks.addTask.post");

    Route::get("tasks/status/{id}", [TaskManager::class,"updateTaskStatus"])
        ->name("tasks.updateTaskStatus");

    Route::get("tasks/delete/{id}", [TaskManager::class,"deleteTask"])
        ->name("tasks.deleteTask");
});


// commands used
// php artisan make:controller AuthManager
// php artisan make:controller WorkSpace
// php artisan make:controller TaskManager
// php artisan make:migration tasks
// php artisan make:model Tasks