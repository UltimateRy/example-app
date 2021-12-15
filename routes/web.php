<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')->middleware(['auth']);

    //})->middleware(['auth'])->name('dashboard');

//Route::get('profile/{username?}', function($user = null){
//    return view('profile', ['username'=>$user]);
//});

//PROFILES ROUTES

Route::get('/profiles', [ProfileController::class, 'index'])
    ->name('profiles.index')->middleware(['auth', 'role']);
Route::get('/profiles/{id}', [ProfileController::class, 'show'])
    ->name('profiles.show')->middleware('auth');


//POSTS ROUTES

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index')->middleware(['auth', 'role']);
Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store')->middleware('auth');
Route::get('/posts/{id}', [PostController::class, 'show'])
    ->name('posts.show')->middleware('auth');
Route::delete('posts/{id}', [PostController::class, 'destroy'])
    ->name('posts.destroy')->middleware(['auth']);
Route::get('posts/{id}/edit', [PostController::class, 'edit'])
    ->name('posts.updatePage')->middleware(['auth']);
Route::post('posts/{id}/edit', [PostController::class, 'update'])
    ->name('posts.update')->middleware(['auth']);


//COMMENT ROUTES

Route::delete('comments/{id}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')->middleware(['auth']);
Route::get('comments/{id}/edit', [CommentController::class, 'edit'])
    ->name('comments.updatePage')->middleware(['auth']);
Route::patch('comments/{id}/edit', [PostController::class, 'update'])
    ->name('comments.update')->middleware(['auth']);


require __DIR__.'/auth.php';
