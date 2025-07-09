<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            return view('blogs.index', ['blogs' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

    $data = [
        [
            'id' => 1,
            'title' => 'Laravel Başlangıç',
            'description' => 'Laravel ile projeye başlama adımları',
            'likeCount' => 50,
            'active' => true,
        ]
    ];
    return view('blogs.show', ['blogs' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
