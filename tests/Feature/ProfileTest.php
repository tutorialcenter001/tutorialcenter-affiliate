<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the profile page to authenticated users', function () {
    $user = User::factory()->create([
        'firstname' => 'Ada',
        'surname' => 'Lovelace',
        'email' => 'ada@example.com',
    ]);

    $this->actingAs($user)
        ->get(route('profile.show'))
        ->assertSuccessful()
        ->assertSee('Ada Lovelace')
        ->assertSee('ada@example.com')
        ->assertSee('Edit Profile')
        ->assertSee('Add Account');
});

it('stores a bank account for the authenticated user', function () {
    $user = User::factory()->create([
        'firstname' => 'Ada',
        'surname' => 'Lovelace',
    ]);

    $this->actingAs($user)
        ->post(route('profile.bank-accounts.store'), [
            'bank_name' => 'GTBank',
            'account_number' => '0123456789',
        ])
        ->assertRedirect(route('profile.show'))
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('bank_accounts', [
        'user_id' => $user->id,
        'bank_name' => 'GTBank',
        'account_name' => 'Ada Lovelace',
        'account_number' => '0123456789',
        'is_default' => true,
    ]);
});

it('does not allow bank account names to be submitted manually', function () {
    $user = User::factory()->create([
        'firstname' => 'Ada',
        'surname' => 'Lovelace',
    ]);

    $this->actingAs($user)
        ->post(route('profile.bank-accounts.store'), [
            'bank_name' => 'GTBank',
            'account_name' => 'Another Person',
            'account_number' => '0123456789',
        ])
        ->assertSessionHasErrors('account_name');

    $this->assertDatabaseMissing('bank_accounts', [
        'user_id' => $user->id,
        'account_name' => 'Another Person',
    ]);
});

it('updates the authenticated user profile', function () {
    $user = User::factory()->create([
        'firstname' => 'Ada',
        'surname' => 'Lovelace',
        'phone_number' => null,
    ]);
    $user->bankAccounts()->create([
        'bank_name' => 'GTBank',
        'account_name' => 'Ada Lovelace',
        'account_number' => '0123456789',
        'is_default' => true,
    ]);

    $this->actingAs($user)
        ->patch(route('profile.update'), [
            'firstname' => 'Grace',
            'surname' => 'Hopper',
            'phone_number' => '08012345678',
        ])
        ->assertRedirect(route('profile.show'))
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'firstname' => 'Grace',
        'surname' => 'Hopper',
        'phone_number' => '08012345678',
    ]);
    $this->assertDatabaseHas('bank_accounts', [
        'user_id' => $user->id,
        'account_name' => 'Grace Hopper',
    ]);
});
