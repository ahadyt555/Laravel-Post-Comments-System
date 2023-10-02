<?php
use resources\views\manageposts;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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
        Route::get('/delete/{id}' , [PostController::class, 'destroy' ])->name('destroy');
    });
    Route::post('/comments/create/{post_id}',     [CommentController::class, 'create'])->name('comments.create');
    Route::get('/comments/show/{post_id}',[CommentController::class, 'show'])->name('comments.show');


require __DIR__.'/auth.php';