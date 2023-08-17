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

    // Controller to return all active blog posts
    public function showPosts()
    {
        $activePosts = Post::where('isActive', true)->get();
        return view('posts.showPosts')->with('posts', $activePosts);
    }


    // Controller to return 3 random active posts as Featured Posts in Welcome Page
    public function welcome()
    {
        // Retrieve all active posts
        $activePosts = Post::where('isActive', true)->get();

        // Check if there are at least 3 active posts
        // If yes, select 3 random active posts; otherwise, select all available active posts
        $randomPosts = $activePosts->count() >= 3 ? $activePosts->random(3) : $activePosts;

        // Pass the random featured posts to the welcome view
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

    // Action that will return a view showing a specific post using the URL parameter $id to query for the database entry to be shown
    public function show($id)
    {
        // Find the Post record with the given $id or throw an exception if not found
        $post = Post::findOrFail($id);

        // Pass the retrieved Post model instance to the 'posts.show' view using the compact function to create an associative array with the variable name 'post'
        return view('posts.show', compact('post'));
    }


    // Action that will edit a specific post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Action that will update the edited post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Update the title and content of the Post with data from the incoming Request
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', ['id' => $post->id])->with('success', 'Post updated successfully.');
    }

    // Action that will archive a post
    public function archive($id){
        $post = Post::find($id);
        $posts = Post::all();

        $post->isActive = false;
        $post->save();

        
        return redirect('/posts')->with('archived', 'Post archived successfully.');
    }

}
