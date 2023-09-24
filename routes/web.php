<?php
use resources\views\manageposts;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/user-post', function () {
        return view('userposts');
    });

    Route::get('/dashboard', function () {
        return view('/dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function() {
            Route::get('/create',     [PostController::class, 'create'])->name('create');//posts.create
            Route::post('/',    [PostController::class,'store'])->name('save');
            Route::get('/list', [PostController::class, 'list'])->name('list');  
        });
            });
    Route::group(['prefix' => 'manageposts', 'as' => 'manageposts.'], function() {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{id}', [PostController::class,'show'])->name('show');
        Route::get('/edit/{id}', [PostController::class,'edit'])->name('edit');
        Route::put('/update/{id}', [PostController::class,'update'])->name('update');
    });







// Route::post('/store-post', 'PostController@store')->name('store-post');
// routes/web.php


require __DIR__.'/auth.php';