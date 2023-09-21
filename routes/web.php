<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user-post', function () {
    return view('userposts');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function() {
        Route::get('/',     [PostController::class, 'create'])->name('create');
        Route::post('/',    [PostController::class,'store'])->name('save');
        Route::get('/list', [PostController::class, 'list'])->name('list');    
    });
    
});




// Route::post('/store-post', 'PostController@store')->name('store-post');
// routes/web.php


require __DIR__.'/auth.php';
