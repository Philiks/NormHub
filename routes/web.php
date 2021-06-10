<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'dashboard')->name('dashboard');
Route::view('/about-us', 'about-us')->name('about-us');

Route::get('/blog', [BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth'])->group(function () {
    Route::view('/terms-and-services', 'terms-and-services')->name('terms-and-services');
    Route::view('/blogs', 'blog.blogs')->middleware('isAdmin')->name('blogs');
    Route::resource('/blog', BlogController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';
