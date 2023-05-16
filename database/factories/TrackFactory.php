<?php

namespace Database\Factories;

use App\Models\Customer\Album;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\Track>
 */
class TrackFactory extends Factory
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
            'albumID' => Album::all()->random()->id,
            'name' => fake()->sentence(4),
            'URL' => 'https://open.spotify.com/playlist/2l71qq4FBusrAh261dMBWv?si=d52a99ea2cef472c',
        ];
    }
}
