<?php
use App\Http\Controllers\CGCareer;
use App\Http\Controllers\GameDevelopment;
use App\Http\Controllers\WebDevelopment;
use App\Http\Controllers\Task;
use Illuminate\Support\Facades\Route;
// classes of controllers must load, if you want to use bellow
Route::get('/', [Task::class,'index']);

Route::post('/addtask', [Task::class,'store'])->name('task');
