@extends("layouts.app")

@section('tabName')
    Newsfeed
@endsection

@section('content')
    <h3>Newsfeed</h3>

    @if(count($posts)>0)

        @foreach($posts as $post)

            <div class = "card text-center col-3 mx-auto mt-2">
                <div class = "card-body">
                    <h4 class = "card-title mb-3">
                        <a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                    <h6 class = "card-text mb-3">Author: {{$post->user->name}}</h6>
                    <p class = "card-subtitle mb-3 text-muted">Created at: {{$post->created_at}}</p>
                </div>

                @if(Auth::user())
                    <!-- if the authenticated user is the author of this blog post -->
                    @if(Auth::user()->id == $post->user_id)
                        <div class="card-footer">
                            <form method="POST" id="archive-form-{{ $post->id }}" action="{{ route('posts.archive', ['id' => $post->id]) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-primary">Edit Post</a>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to archive this post?')">Delete Post</button>
                            </form>
                        </div>
                    @endif

                @endif
            </div>

        @endforeach

    @else
        <div>
            <h2>There are no posts to show</h2>
            <a href="/posts/create" class = "btn btn-info">Create Post</a>
        </div>
    @endif
@endsection