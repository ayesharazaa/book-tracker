<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReadingProgressController;


Route::get('/', [BookController::class, 'browse'])->name('home');

Route::view('/register', 'auth.register')->middleware('guest')->name('register');
Route::post('/register', \App\Http\Controllers\Auth\Register::class)->middleware('guest');

Route::post('/logout', \App\Http\Controllers\Auth\Logout::class)->middleware('auth')->name('logout');


Route::view('/login', 'auth.login')->middleware('guest')->name('login');
Route::post('/login', \App\Http\Controllers\Auth\Login::class)->middleware('guest'); 

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/library', [LibraryController::class, 'index'])->name('library');
    Route::post('/library/add', [LibraryController::class, 'addBook'])->name('library.add');
    Route::get('/book/{id}', [ReadingProgressController::class, 'show'])->name('show');
    Route::post('/book/{id}/progress', [ReadingProgressController::class, 'updateProgress'])->name('book.progress');
    Route::post('/book/{id}/review', [ReadingProgressController::class, 'updateReview'])->name('book.review');
});
 