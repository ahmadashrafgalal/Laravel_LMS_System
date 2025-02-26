<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'guest', 'throttle:60,1'])->group(function () {
    
    Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
    Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');

    Route::get('/forgot-password', [App\Http\Controllers\PasswordForgotController::class, 'index'])->name('forgot-password');

});

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::get('/home', function(){dd("Logged in");})->name('home');

    Route::get('/email/verify',  [App\http\Controllers\EmailVerificationController::class, 'Verification_notice'])->withoutMiddleware('verified')->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', [App\http\Controllers\EmailVerificationController::class, 'VerifyEmail'])->middleware('signed')->withoutMiddleware('verified')->name('verification.verify');

    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->withoutMiddleware('guest')->name('logout');
});




