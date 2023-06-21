<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\API\PostController as PostAPIController;
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

//Route::get('/posts',[postController::class,'displaypost']);
//Route::get('/postController/display',[postController::class,'displaypost']);
//Route::get('/post/create',[postController::class,'createpost'])->name('post.create');
//Route::get('/posts',[postController::class,'index'])->name('post.index');
//Route::get('/post/{id}',[postController::class,'show'])->name('post.show');
//
//Route::get('/post/{id}/destroy',[postController::class,'destroy'])->name('post.destroy');
//
///////////////////////////////////////////////////////////////////////
//
//Route::put('/post/{id}', [PostController::class,'update'])->name('post.update');
//
//////////////////////////////////////////////////
//
//Route::get('/post/{id}/edit',[postController::class,'edit'])->name('post.edit');
//
//Route::post('/createpost',[postController::class,'save'] )->name('post.save');
//
//Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/users', [UserController::class,'index'])->name('user.index');

Route::resource('/post',PostController::class );

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

/*routes lab 5*/

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('posts/objects ',[PostController::class,'get_posts']);

Route::post('/posts', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('auth:sanctum');
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('auth:sanctum');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


////////////////


Route::get('/search', [PostController::class, 'search'])->name('post.search');
