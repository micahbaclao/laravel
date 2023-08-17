@extends('layouts.app')

@section('tabName')
    Edit Post
@endsection

@section('content')
<div class="container col-6 mx-auto">

    <!-- Edit Post Form -->
    <div>
        <h3>Edit Post</h3>
        <p class = "card-subtitle mb-3 text-muted">Created at: {{$post->created_at}}</p>
        <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
            @csrf
            @method('PUT')

            <!-- Title Input -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>

            <!-- Content Textarea -->
            <div class="form-group mt-2">
                <label for="content"> Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn-primary mt-2">Update Post</button>
        </form>
    </div>
</div>
@endsection
