<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'guest', 'throttle:60,1'])->group(function () {
    Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
    Route::get('/forgot-password', [App\Http\Controllers\PasswordForgotController::class, 'index'])->name('forgot-password');

    Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');
});

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::get('/home', function(){
        dd("Logged in");
    })->name('home');

});

Route::get('/email/verify', function(){
    dd("You need to verify your email");
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request){
    $request->fulfill();
    # update active to 1
    $user = $request->user();
    $user->active = 1;
    $user->save();

})->middleware(['auth', 'signed'])->name('verification.verify');
