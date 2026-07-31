<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // public function definition(): array
    // {
    //     return [
    //         'firstname' => fake()->firstName(),
    //         'surname' => fake()->lastName(),
    //         'email' => fake()->unique()->safeEmail(),
    //         'email_verified_at' => now(),
    //         'password' => static::$password ??= Hash::make('password'),
    //         'referral_code' => fake()->unique()->regexify('[A-Z0-9]{8}'),
    //         'role' => fake()->randomElement(['affiliate', 'admin', 'user']),
    //         'profile_picture' => null,
    //         'phone_number' => fake()->phoneNumber(),
    //         'remember_token' => Str::random(10),
    //     ];
    // }

    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'referral_code' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'role' => $this->faker->randomElement(['affiliate', 'admin', 'user']),
            'profile_picture' => null,
            'phone_number' => $this->faker->phoneNumber(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
