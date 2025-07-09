<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});
Route::get('/blogs', function () {
    $data = [
        [
            'id' => 1,
            'title' => 'Laravel Başlangıç',
            'description' => 'Laravel ile projeye başlama adımları',
            'likeCount' => 50,
            'active' => true,
        ],
        [
            'id' => 2,
            'title' => 'Laravel Orta Seviye',
            'description' => 'Orta seviye Laravel dersleri',
            'likeCount' => 75,
            'active' => false,
        ],
        [
            'id' => 3,
            'title' => 'Laravel İleri Seviye',
            'description' => 'İleri seviye Laravel teknikleri',
            'likeCount' => 120,
            'active' => true,
        ]
    ];
    return view('blogs', ['blogs' => $data]);
});



Route::get('/blogs/{id}', function (int $id) {
    $blogs = [
        [
            'id' => 1,
            'title' => 'Laravel Başlangıç',
            'description' => 'Laravel ile projeye başlama adımları',
            'likeCount' => 50,
            'active' => true,
        ],
        [
            'id' => 2,
            'title' => 'Laravel Orta Seviye',
            'description' => 'Orta seviye Laravel dersleri',
            'likeCount' => 75,
            'active' => false,
        ],
        [
            'id' => 3,
            'title' => 'Laravel İleri Seviye',
            'description' => 'İleri seviye Laravel teknikleri',
            'likeCount' => 120,
            'active' => true,
        ],
    ];
    $blog = collect($blogs)->firstWhere('id', $id);
    if (!$blog) {
        abort(404);
    }
    return view('blog-details', $blog);
});

