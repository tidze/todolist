<?php

use App\Http\Controllers\CGCareer;
use App\Http\Controllers\GameDevelopment;
use App\Http\Controllers\WebDevelopment;
use Illuminate\Support\Facades\Route;
// classes of controllers must load, if you want to use bellow
Route::get('/', function (){return view('welcome');});

Route::get('/webdev', WebDevelopment::class)->name('web-developement');
Route::get('/gamedev', GameDevelopment::class)->name('game-developement');
Route::get('/cg', CGCareer::class)->name('cg-career');

Route::view('epicgames','epicgames.EpicGames')->name('epicgames');
Route::view('epicgames-faq','epicgames.EpicGames-FAQ')->name('epicgames-faq');
Route::view('epicgames-news','epicgames.EpicGames-news')->name('epicgames-news');
Route::view('epicgames-sign-in','epicgames.EpicGames-sign-in')->name('epicgames-sign-in');
