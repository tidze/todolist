<?php

use App\Http\Controllers\CGCareer;
use App\Http\Controllers\GameDevelopment;
use App\Http\Controllers\WebDevelopment;
use App\Http\Controllers\Task;
use App\Http\Livewire\LivewireBase;
use App\Http\Livewire\Scroller;
use App\Http\Livewire\Task as TaskLivewire;
use App\Http\Livewire\Chart as ChartLivewire;
use Illuminate\Support\Facades\Route;
// classes of controllers must load, if you want to use bellow
// Route::get('/', TaskLivewire::class);
Route::get('/', function (){
    return view('layouts.app');
});
Route::get('/duck', LivewireBase::class)->name('duck');
Route::post('/duck-post', LivewireBase::class)->name('duck-post');

// Route::post('/addtask', [Task::class,'store'])->name('task');

// Route::post('/addtask', TaskLivewire::class)->name('TaskAdd');
// Route::post('/addtask',  [TaskLivewire::class,'store'])->name('TaskAdd');
// Route::post('/deletetask', [TaskLivewire::class,'deleteId'])->name('TaskDelete');

// Route::view('/scroller', 'livewire.scroller');
// Route::get('/chart',ChartLivewire::class);
