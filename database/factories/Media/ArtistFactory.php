<?php

namespace Database\Factories\Media;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customerID' => Customer::all()->random()->id,
            'name' => fake()->name(),
            'profilePictureURL' => fake()->imageUrl(),
            'profileURL' => 'https://open.spotify.com/playlist/2l71qq4FBusrAh261dMBWv?si=d52a99ea2cef472c',
        ];
    }
}