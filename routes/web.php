<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

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

    Route::post('/logout', [UserController::class, 'logoutUser'])
        ->name('logout');
});