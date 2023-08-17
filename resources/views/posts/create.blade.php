@extends('layouts.app')

@section('tabName')
    Create Post
@endsection

@section('content')

	
	<form class="col-3 bg-warning p-5 mx-auto" method="POST" action="/posts">
		<!-- CSRF stands for Cross-Site Request Forgery. It is form of attact where malicious users may send malicious request while pretending to be authorize user. Laravel uses token to detect if form input request have not been tampered with. -->
		@csrf
		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" name="title" class="form-control" id="title" />
		</div>

		<div class="form-group mt-2">
			<label for="content">Content:</label>
			<textarea class="form-control" id="content" name="content" rows=3></textarea>
		</div>

		<div class="mt-2 mx-auto">
			<button class="btn btn-primary">Create Post</button>
		</div>
	</form>
@endsection