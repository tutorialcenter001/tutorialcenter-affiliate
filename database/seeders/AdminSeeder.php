<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'Tutorial',
            'surname' => 'Center',
            'email' => 'tutorialcenter001@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Qwertyuiop@1'),
            'referral_code' => 'ADMIN001',
            'role' => 'admin',
            'profile_picture' => null,
            'phone_number' => '08029606405',
        ]);
    }
}
