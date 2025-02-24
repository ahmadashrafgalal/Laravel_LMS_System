<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'guest', 'throttle:60,1'])->group(function () {
    Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
    Route::get('/forgot-password', [App\Http\Controllers\PasswordForgotController::class, 'index'])->name('forgot-password');

    Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');
});