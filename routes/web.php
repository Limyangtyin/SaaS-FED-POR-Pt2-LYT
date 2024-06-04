<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPages;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('listings', [StaticPages::class, 'listings'])
    ->name('listings');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified'])->group(function (){
    // Show all users in the trash
    Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');

    // Recover a user from trash
    Route::get('users/trash/{id}/recover', [UserController::class, 'restore'])->name('users.recover');

    // Empty user trash
    Route::get('users/trash/empty', [UserController::class, 'empty'])->name('users.empty');

    // Recover all user from the trash
    Route::post('users/trash/recover', [UserController::class, 'recoverAll'])->name('users.recoverAll');

    // Delete a user
    Route::delete('users/{id}/trash/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('users', UserController::class);
    // Retrieve user for delete confirmation
    Route::get('users/{user}/delete', [UserController::class, 'delete'])->name('user.delete');

    // Confirm delete a user
    Route::delete('users/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
});

Route::middleware(['auth', 'verified'])->group(function (){
//    //Direct to index
//    Route::get('listings', [ListingController::class, 'index'])->name('listings.index');
//
//    // Show all listings
//    Route::get('listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
//
////    // Create And Store Listing
////    Route::get('listings/create', [ListingController::class, 'create'])->name('listings.create');
////    Route::post('listings', [ListingController::class, 'store'])->name('listings.store');
//
//    // Edit And Update Listing Detail
//    Route::get('listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
//    Route::put('listings/{listing}', [ListingController::class, 'update'])->name('listings.update');

    // Show all listings in the trash
    Route::get('listings/trash', [ListingController::class, 'trash'])->name('listings.trash');

    // Recover a listing from trash
    Route::get('listings/trash/{id}/recover', [ListingController::class, 'restore'])->name('listings.recover');

    // Empty listing trash
    Route::get('listings/trash/empty', [ListingController::class, 'empty'])->name('listings.empty');

    // Recover all listing from the trash
    Route::post('listings/trash/recover', [ListingController::class, 'recoverAll'])->name('listings.recoverAll');

    // Delete a listing
    Route::delete('listings/{id}/trash/destroy', [ListingController::class, 'destroy'])->name('listings.destroy');

    Route::resource('listings', ListingController::class);
    // Retrieve listing for delete confirmation
    Route::get('listings/{listing}/delete', [ListingController::class, 'delete'])->name('listing.delete');

    // Confirm delete a listing
    Route::delete('listings/{listing}/delete', [ListingController::class, 'delete'])->name('listing.delete');
});

require __DIR__.'/auth.php';
