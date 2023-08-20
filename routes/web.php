<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//This route is for logging out.
Route::get('/logout', [PostController::class, 'logout']);

//This route is for creation of a new post:
Route::get('/posts/create', [PostController::class, 'createPost']);

//This route is for saving the post on our database:
Route::post('/posts', [PostController::class, 'savePost']);

//Only logged in users can read all posts
Route::middleware(['auth'])->group(function () {
    //This route is for the list of post on our database:
    Route::get('/posts', [PostController::class, 'showPosts'])->name('posts.show');

    //This route will return a view of a specific post matching the URL parameter ID
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
});

//Route that will show the welcome page showing Featured Posts, if any:
Route::get('', [PostController::class, 'welcome']);

//Define that will return a view containing only the aithenticated user's post
Route::get('/myPosts', [PostController::class, 'myPosts']);

//Route for editing a post
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

//Route for updating a post
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

//Route for archiving a post
Route::delete('/posts/{id}', [PostController::class, 'archive'])->name('posts.archive');

//Define a web rout that will call the function for liking and unliking a specific post:
Route::put('/posts/{id}/like', [PostController::class, 'like']);

// Route to handle commenting
Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');

