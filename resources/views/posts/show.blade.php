@extends('layouts.app')

@section('tabName')
    {{$post->title}}
@endsection
@section('content')

    <div class="card col-6 mx-auto">    
        <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <p class="card-subtitle text-muted">Author: {{$post->user->name}}</p>
            <p class="card-subtitle text-muted mb-3">Created at: {{$post->created_at}}</p>
            <h4>Content:</h4>
            <p class="card-text">{{$post->content}}</p>

            <!-- <h1>{{$post->likes->where('user_id', Auth::id())}}</h1> -->

            <!-- Logged user is not poster of blog -->
            
            @if(Auth::user())
                @if(Auth::id() != $post->user_id)


                <form class="d-inline" method="POST" action="/posts/{{$post->id}}/like">
                    @method('PUT')
                    @csrf
                    <!-- If the user already liked the post or not -->
                    @if($post->likes->contains('user_id', Auth::id()))
                        <button class="btn btn-danger">Unlike</button>
                    @else
                        <button class="btn btn-success">Like</button>
                    @endif

                </form>


                @endif

                <form class="d-inline" method="POST" action="">
                        <button class="btn btn-primary" id="commentButton">Comment</button>
                </form>

            @endif
            <br/>
            <br/>


            <a href="/posts" class="card-link">View all post</a>
        </div>
    </div>

    <!-- HTML MODAL START-->
    <div class="modal" tabindex="-1" id="commentModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Leave a comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h3 class="modal-subtitle">Comment:</h3>
          </div>
          <div class="modal-body">
            <textarea row = 3></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Comment</button>
          </div>
        </div>
      </div>
    </div>
    <!-- HTML MODAL END -->

@endsection