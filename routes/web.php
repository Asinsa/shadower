<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InteractionController;

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

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('posts.create');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/create', [ProfileController::class, 'create'])->middleware(['auth', 'verified'])->name('profiles.create');
Route::post('profiles', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
Route::delete('/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/interactions', [InteractionController::class, 'index'])->name('interactions.index');
Route::post('/interactions', [InteractionController::class, 'store'])->name('interactions.store');
Route::put('/interactions/{id}', [InteractionController::class, 'update'])->name('interactions.update');
Route::delete('/interactions/{id}', [InteractionController::class, 'destroy'])->name('interactions.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
