<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [SearchController::class, 'store'])->name('search.store');
Route::get('/search/{search}', [SearchController::class, 'show'])->name('search.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin');
Route::post('/admin', [AdminController::class, 'store'])->middleware(['auth']);

Route::get('/profile', [UserController::class, 'index'])->middleware(['auth'])->name('profile');
Route::get('/profile/edit', [UserController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::put('/profile/edit', [UserController::class, 'update'])->middleware(['auth'])->name('profile.update');
Route::get('/profile/{id}', [UserController::class, 'show'])->name('profileId');


// Route::get('/search/{search}', [UserController::class, 'search'])->name('search');


Route::get('/uploadPodcast', [PodcastController::class, 'create'])->middleware(['auth'])->name('uploadPodcast');
Route::post('/uploadPodcast', [PodcastController::class, 'store'])->middleware(['auth'])->name('uploadPodcastPost');

Route::get('/podcast/{id}', [PodcastController::class, 'show'])->name('podcast');
Route::post('/podcast/{id}', [CommentController::class, 'store']);

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
