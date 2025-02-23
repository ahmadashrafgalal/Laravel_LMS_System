<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::get('/forgot-password', [App\Http\Controllers\PasswordForgotController::class, 'index'])->name('forgot-password');
