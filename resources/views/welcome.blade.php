@extends('layouts.app')

@section('tabName')
    Welcome
@endsection

@section('content')
<img src="https://cdn.freebiesupply.com/logos/large/2x/laravel-1-logo-png-transparent.png" class="rounded col-4 mx-auto d-block" alt="...">

@if($randomPosts->count() > 0)
    <h3 class="text-center mt-3">Featured Posts</h3>

    <div class="column justify-content-center">
        @foreach($randomPosts as $post)
            <div class="card text-center col-3 mx-auto mt-2">
                <div class="card-body">
                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                    <p class="card-subtitle mb-3 text-muted">Author: {{ $post->user->name }}</p>
                </div>
            </div>
        @endforeach
    </div>

@else
    <div class="text-center mt-3">
        <h2>There are no fatured posts to show</h2>
        @auth
            <a href="/posts/create" class="btn btn-primary">Create Post</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login to Create a Post</a>
        @endauth
    </div>
@endif
@endsection
