<?php

use App\Http\Controllers\ReferralController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile.show');

    Route::patch('/profile', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    Route::post('/profile/bank-accounts', [UserController::class, 'storeBankAccount'])
        ->name('profile.bank-accounts.store');

    Route::get('/withdrawals', [UserController::class, 'withdrawals'])
        ->name('withdrawals.index');

    Route::post('/withdrawals', [UserController::class, 'storeWithdrawal'])
        ->name('withdrawals.store');

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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');

    Route::get('/users/export', [AdminController::class, 'exportUsers'])->name('users.export');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/referrals', [AdminController::class, 'referrals'])->name('referrals.index');

    Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('withdrawals.index');

    Route::patch('/withdrawals/{withdrawal}/approve', [AdminController::class, 'approveWithdrawal'])
        ->name('withdrawals.approve');

    Route::patch('/withdrawals/{withdrawal}/reject', [AdminController::class, 'rejectWithdrawal'])
        ->name('withdrawals.reject');

    Route::patch('/withdrawals/{withdrawal}/mark-sent', [AdminController::class, 'markWithdrawalSent'])
        ->name('withdrawals.sent');

    Route::get('/pending-affiliates', [AdminController::class, 'pendingAffiliates'])->name('affiliates.pending');

    Route::get('/earnings/pending', [AdminController::class, 'pendingEarnings'])
        ->name('earnings.pending');

    Route::patch('/earnings/{earning}/approve', [AdminController::class, 'approveEarning'])
        ->name('earnings.approve');

    Route::patch('/earnings/{earning}/decline', [AdminController::class, 'declineEarning'])
        ->name('earnings.decline');
});
