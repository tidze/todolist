<?php

use App\Http\Controllers\AboutMe;
use App\Http\Controllers\lab;
use App\Http\Controllers\ProfileController;
use App\View\Components\CustomCalendar;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/aboutme', AboutMe::class)->name('aboutme');
Route::get('/kir', function () {
    return view('gridBackground');
});

require __DIR__ . '/auth.php';

// This URL is for testing components
Route::get('/lab', [lab::class,'index']);