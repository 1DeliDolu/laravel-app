@extends('layouts.layout')
@section('content')
@if($active)
   <div class="card">
    <div class="card-body">
        <h5>{{ $title }}</h5>
        <p>{{ $description }}</p>
        <p>Likes: {{ $likeCount }} beğeni</p>
        <p>Status: {{ $active ? 'Active' : 'Inactive' }}</p>
    </div>
   </div>
@else
   <div class="alert alert-warning">
       <p>Blog post is inactive.</p>
   </div>
@endif
@endsection
