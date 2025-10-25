<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;



Route::get('/login', [AuthManager::class, 'login'])
    ->name('login');

Route::post('/login', [AuthManager::class, 'loginPost'])
    ->name('login.post');

Route::get('/register', [AuthManager::class, 'register'])
    ->name('register');

Route::post('/register', [AuthManager::class, 'registerPost'])
    ->name('register.post');

Route::middleware("auth")->group(function(){
    Route::get('/', [TaskManager::class, "listTask"])
    ->name('home');

    // Route::get("tasks/listTask", [TaskManager::class,"listTask"])
    //     ->name("tasks.listTask");

    Route::get("tasks/addTask", [TaskManager::class,"addTask"])
        ->name("tasks.addTask");

    Route::post("tasks/addTask", [TaskManager::class,"addTaskPost"])
        ->name("tasks.addTask.post");
});


// commands used
// php artisan make:controller AuthManager
// php artisan make:controller WorkSpace
// php artisan make:controller TaskManager
// php artisan make:migration tasks
// php artisan make:model Tasks