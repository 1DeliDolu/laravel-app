<?php
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index']);
Route::get('/index', [HomeController::class,'index']);
/* contact */
Route::get('/contact', [HomeController::class,'contact']);

Route::get('/blogs', [BlogsController::class, 'index']);

Route::get('/blogs/{id}', [BlogsController::class,'show']);


