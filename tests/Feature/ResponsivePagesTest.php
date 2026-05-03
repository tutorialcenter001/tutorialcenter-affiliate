<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders guest-facing pages after responsive updates', function (string $uri, string $text) {
    $this->get($uri)
        ->assertSuccessful()
        ->assertSee($text);
})->with([
    'welcome' => ['/', 'Earn with TC'],
    'register' => ['/register', 'Create Account'],
    'login' => ['/login', 'Login'],
    'verify account' => ['/verify-account', 'Verify Your Account'],
    'forgot password' => ['/forgot-password', 'Forgot Password'],
    'reset password' => ['/reset-password/mobile-token?email=affiliate@example.com', 'Reset Password'],
]);

it('renders authenticated dashboard pages after responsive updates', function (string $uri, string $text) {
    $user = User::factory()->create([
        'firstname' => 'Ada',
        'surname' => 'Lovelace',
        'email_verified_at' => now(),
    ]);

    $this->actingAs($user)
        ->get($uri)
        ->assertSuccessful()
        ->assertSee($text);
})->with([
    'dashboard' => ['/dashboard', 'Total Referrals'],
    'referrals' => ['/referrals', 'My Referrals'],
    'earnings' => ['/earnings', 'My Earnings'],
    'profile' => ['/profile', 'Profile Information'],
]);
