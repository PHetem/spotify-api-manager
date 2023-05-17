<?php

namespace Database\Factories\Media;

use App\Models\Customer\Customer;
use App\Models\Media\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\Album>
 */
class AlbumFactory extends Factory
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
            'artistID' => Artist::all()->random()->id,
            'name' => fake()->sentence(4),
            'coverImageURL' => fake()->imageUrl(),
            'URL' => 'https://open.spotify.com/playlist/2l71qq4FBusrAh261dMBWv?si=d52a99ea2cef472c',
        ];
    }
}
