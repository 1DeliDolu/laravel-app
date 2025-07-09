<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});
Route::get('/blogs', function () {
    return view('blogs');
});

Route::get('/blogs/{id}', function (int $id) {
    return view('blog-details', ['id' => $id]);
});

