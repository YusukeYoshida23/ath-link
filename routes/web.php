<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;


Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');
Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');
Route::resource('post', PostController::class);

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
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'can:admin')->group(function () {
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/adedit/{user}', [ProfileController::class, 'adedit'])->name('profile.adedit');
    Route::patch('/profile/adupdate/{user}', [ProfileController::class, 'adupdate'])->name('profile.adupdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store');


Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // お問い合わせ
Route::controller(ContactController::class)->group(function(){
    Route::get('contact/create', 'create')->name('contact.create')->middleware('guest');
    Route::post('contact/store', 'store')->name('contact.store');
});

require __DIR__.'/auth.php';
