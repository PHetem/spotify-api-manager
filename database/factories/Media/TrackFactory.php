<?php

namespace Database\Factories\Media;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'spotifyID' => Str::random(10),
            'customerID' => Customer::all()->random()->id,
            'name' => fake()->sentence(4),
            'URL' => 'https://open.spotify.com/playlist/2l71qq4FBusrAh261dMBWv?si=d52a99ea2cef472c',
        ];
    }
}
