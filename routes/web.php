<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

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

//This route is for the list of post on our database:
Route::get('/posts', [PostController::class, 'showPosts']);

//This route is for Laravel S02 Activiy
Route::get('', [PostController::class, 'welcome']);

//Define that will return a view containing only the aithenticated user's post
Route::get('/myPosts', [PostController::class, 'myPosts']);

//Define a route wherein a view showing a specific post with matching URL parameter ID will be returned to the user
// Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

//Define a route for editing a post
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

//Route for updating a post
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');


