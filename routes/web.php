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

Route::get('/blog/{id}', [BlogController::class, 'show']);

Route::middleware(['auth'])->group(function () {
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::resource('blog', BlogController::class);
});

require __DIR__.'/auth.php';
