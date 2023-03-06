<?php

<<<<<<< Updated upstream
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
=======
use App\Http\Controllers\CGCareer;
use App\Http\Controllers\GameDevelopment;
use App\Http\Controllers\WebDevelopment;
use App\Http\Controllers\Task;
use Illuminate\Support\Facades\Route;
// classes of controllers must load, if you want to use bellow
Route::get('/', [Task::class,'index']);

Route::post('/addtask', [Task::class,'store'])->name('task');

>>>>>>> Stashed changes
