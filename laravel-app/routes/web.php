<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Musta-Liste anzeigen
Route::get('/musta', function () {
    $mustas = [
        ["name" => "Musta", "skill" => "PHP", "id" => 1],
        ["name" => "Musta", "skill" => "Laravel", "id" => 2],
    ];
    $greeting = "Hello";
    return view('musta.index', [
        "greeting" => $greeting,
        "mustas" => $mustas
    ]);
});

// Einzelnen Musta anzeigen
Route::get('/musta/{id}', function ($id) {
    $mustas = [
        ["name" => "Musta", "skill" => "PHP", "id" => 1],
        ["name" => "Musta", "skill" => "Laravel", "id" => 2],
    ];
    // passender Musta anhand der ID finden
    $musta = collect($mustas)->firstWhere('id', (int) $id);

    $greeting = "Hello";
    return view('musta.show', [
        "id" => $id,
        "musta" => $musta,
        "mustas" => $mustas,
        "greeting" => $greeting
    ]);
});
