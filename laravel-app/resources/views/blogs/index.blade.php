@extends('layouts.layout')
@section('content')
<h1>Blog List</h1>
@foreach($blogs as $blog)
    @if($blog['active'])
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $blog['title'] }}</h5>
                <p>{{ $blog['description'] }}</p>
                <p>{{ $blog['likeCount'] }} likes</p>
                <p>ID: {{ $blog['id'] }}</p>
                <p>Active: Yes</p>
            </div>
        </div>
    @endif
@endforeach

<h1>Blog List (For Loop)</h1>
@for ($i = 0; $i < count($blogs); $i++)
    @if($blogs[$i]['active'])
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $blogs[$i]['title'] }}</h5>
                <p>{{ $blogs[$i]['description'] }}</p>
                <p>{{ $blogs[$i]['likeCount'] }} likes</p>
                <p>ID: {{ $blogs[$i]['id'] }}</p>
                <p>Active: Yes</p>
            </div>
        </div>
    @endif
@endfor
@endsection

