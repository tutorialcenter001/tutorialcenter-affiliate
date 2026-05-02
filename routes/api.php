<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferralController;

Route::post('/referrals/register', [ReferralController::class, 'store']);