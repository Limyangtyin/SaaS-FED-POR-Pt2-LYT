<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPages;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('welcome', [StaticPages::class, 'welcome'])
    ->name('welcome');

Route::get('/', [StaticPages::class, 'welcome'])
    ->name('home');

Route::get('about', [StaticPages::class, 'about'])
    ->name('about');

Route::get('contact-us', [StaticPages::class, 'contact'])
    ->name('contact-us');

Route::get('pricing', [StaticPages::class, 'pricing'])
    ->name('pricing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function (){
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
