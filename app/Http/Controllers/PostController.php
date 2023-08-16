<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    // Controller for user logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Action to return a view containing a form for a blog post creation
    public function createPost()
    {
        return view('posts.create');
    }

    public function savePost(Request $request)
    {
        if (Auth::user()) {
            $post = new Post;

            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::user()->id;

            $post->save();

            return redirect('/posts');
        } else {
            return redirect('/login');
        }
    }

    // Controller to return all the blog posts
    public function showPosts()
    {
        $posts = Post::all();
        return view('posts.showPosts')->with('posts', $posts);
    }

    // Controller for Laravel S02 Activity
    public function welcome()
    {
        $posts = Post::all();
        $randomPosts = $posts->count() > 3 ? $posts->random(3) : $posts;
        
        return view('welcome')->with('randomPosts', $randomPosts);
    }

    // Action for showing only the posts authored by authenticated user
    public function myPosts()
    {
        if (Auth::user()) {
            $posts = Auth::user()->posts;
            return view('posts.showPosts')->with('posts', $posts);
        } else {
            return redirect('/login');
        }
    }

    // Action that will
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }
}
