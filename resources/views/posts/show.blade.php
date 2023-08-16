@extends('layouts.app')

@section('content')
	<div class="card col-6 mx-auto">
		<div class="card-body">
			<h2 class="card-title">{{$post->title}}</h2>
			<p class="card-subtitle text-muted"> Author: {{$post->user->name}}</p>
			<p class="card-subtitle text-muted mb-3">Created at: {{$post->created_at}}</p>
			<h5>Content:</h5>
			<p class="card-text">{{$post->content}}</p>

			<a href="/posts" class="btn btn-info">View all posts</a>
		</div>
	</div>










@endsection