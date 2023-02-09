<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\BookmarksController;


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('post/{post:slug}', [PostController::class, 'show'])->
    middleware(['no_draft', 'views_count'])->name('post');

Route::post('post/{post:slug}/comments', [PostCommentsController::class, 'store'])->
    middleware(['no_draft', 'auth'])->name('post.comments');

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

// Account routs
Route::get('account/edit', [RegisterController::class, 'edit'])->middleware('auth');
Route::patch('account/edit', [RegisterController::class, 'update'])->middleware('auth');
Route::get('account/bookmarks', [BookmarksController::class, 'index'])->middleware('auth');

Route::get('account/bookmarks/store/{post:slug}', [BookmarksController::class, 'store'])->middleware('auth');
Route::get('account/bookmarks/destroy/{post:slug}', [BookmarksController::class, 'destroy'])->middleware('auth');


Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');


//Route::resource('admin/posts', AdminPostController::class)->except('show')->middleware('can:admin');

// except('show') excludes Show action (it shows only one (single) item) from routes list.
// There is no /admin/posts/show

Route::middleware('can:admin')->group(function () {
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::post('admin/posts', [AdminPostController::class, 'store']);
    Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});
