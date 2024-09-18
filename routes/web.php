<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::get('/posts/{id}/edit', [App\Http\Controllers\PostController::class, 'show'])->name('posts.edit');

Route::post('/posts/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/categories-posts', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');

// Route::resource('posts', App\Http\Controllers\PostController::class);
