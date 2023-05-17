<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'spotifyID' => Str::random(10),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'country' => fake()->countryCode(),
            'followerCount' => rand(1, 999),
            'profileURL' => 'https://open.spotify.com/user/12167234083',
            'profilePictureURL' => fake()->imageUrl(),
            'accountType' => fake()->randomElement(['Premium', 'Family', 'Standard']),
            'accessToken' => Str::random(30),
            'refreshToken' => Str::random(30),
        ];
    }
}
