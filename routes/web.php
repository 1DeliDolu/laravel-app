<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/musta', function () {
  return view('musta.index', ["greeting" => "Hello, Musta!"]);
});
