<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReferralController;

// landing page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// registration page
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::post('/register', [UserController::class, 'store'])
    ->name('register.store');

Route::get('/verify-account', function () {
    return view('auth.verify');
})->name('verification.notice');

Route::get('/verify/{token}', [UserController::class, 'verifyAccount'])
    ->name('verification.verify');

Route::post('/resend-verification', [UserController::class, 'resendVerification'])
    ->name('verification.resend');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])
    ->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/referrals', [ReferralController::class, 'referrals'])
        ->name('referrals.index');

    Route::get('/earnings', [UserController::class, 'earnings'])
        ->name('earnings.index');

    Route::post('/logout', [UserController::class, 'logoutUser'])
        ->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [UserController::class, 'sendPasswordResetLink'])
        ->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', [UserController::class, 'resetPassword'])
        ->name('password.update');
});
