<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\isAuthed;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::controller(PageController::class)->group( function() {
    Route::get('/', 'index')->name('page.index');
    Route::get('/detail-article/{slug}', 'detail')->name('page.detail');
    Route::get('/category/{slug}', 'categorized')->name('page.categorized');
});


Route::resource('comment', CommentController::class)->only(['store', 'update', 'destroy']);

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware(isAuthed::class);


Auth::routes();
// Auth::routes(['register' => false, 'login' => false]);

Route::middleware('auth')->prefix('dashboard')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/users', [HomeController::class, 'users'])->name('home.users');
    Route::resource('articles', ArticleController::class);
    Route::resource('category', CategoryController::class)->middleware('can:admin-only');

});

