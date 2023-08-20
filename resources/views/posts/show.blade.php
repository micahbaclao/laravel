@extends('layouts.app')

@section('tabName')
    {{$post->title}}
@endsection

@section('content')
<div class="card col-md-8 col-lg-8 mx-auto">
    <div class="card-body">
        <h2 class="card-title">{{$post->title}}</h2>
        <p class="card-subtitle text-muted">Author: {{$post->user->name}}</p>
        <p class="card-subtitle text-muted mb-3">Created at: {{$post->created_at}}</p>
        <h4>Content:</h4>
        <p class="card-text">{{$post->content}}</p>

        <!-- Likes and Comment Counts -->
        <p style="font-size: 12px;">Likes: {{$post->likes_count}} | Comments: {{$post->comments->count()}}</p>

        <!-- Like Button (if not the author of the post) -->
        @if(Auth::user() && Auth::id() != $post->user_id)
            <form class="d-inline" method="POST" action="/posts/{{$post->id}}/like">
                @method('PUT')
                @csrf
                @if($post->likes->contains('user_id', Auth::id()))
                    <button class="btn btn-danger">Unlike</button>
                @else
                    <button class="btn btn-success">Like</button>
                @endif
            </form>
        @endif

        <!-- Comment Button -->
        @if(Auth::user())
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">Comment</button>
        @endif

        <br><br>

        <a href="/posts" class="card-link">View all posts</a>
    </div>
</div>

<!-- Comment Modal -->
<div class="modal" tabindex="-1" id="commentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('posts.comment', ['id' => $post->id]) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Leave a comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea name="content" rows="3" class="form-control" placeholder="Your comment..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- List of Comments -->
@if($post->comments->count() > 0)
    <div class="mt-5 col-md-8 col-lg-8 mx-auto">
        <h4 class="mb-3">Comments</h4>
        @foreach($post->comments as $comment)

            <p class="card-subtitle" style="font-size: 12px;">Posted by: {{$comment->user->name}}</p>
            <div class="card my-1">
                <div class="card-body mx-auto">
                    <h6 class="card-text">{{$comment->content}}</h6>
                </div>
            </div>
            <p class="card-subtitle text-muted text-end mb-3" style="font-size: 12px;">{{$comment->created_at->format('F d, Y H:i:s')}}</p>

        @endforeach
    </div>
@else
    <p class="mt-4">No comments yet.</p>
@endif


@endsection
