<?php

namespace Database\Seeders;

use Database\Seeders\Customer\CustomerSeeder;
use Database\Seeders\Media\AlbumSeeder;
use Database\Seeders\Media\ArtistSeeder;
use Database\Seeders\Media\PlaylistSeeder;
use Database\Seeders\Media\PodcastSeeder;
use Database\Seeders\Media\TrackSeeder;
use Database\Seeders\Media\TopTrackSeeder;
use Database\Seeders\Media\TopArtistSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(LogSeeder::class);

        $this->call(CustomerSeeder::class);

        $this->call(PlaylistSeeder::class);
        $this->call(PodcastSeeder::class);
        $this->call(ArtistSeeder::class);
        $this->call(AlbumSeeder::class);
        $this->call(TrackSeeder::class);

        $this->call(TopTrackSeeder::class);
        $this->call(TopArtistSeeder::class);

        $this->call(APITokenSeeder::class);
    }
}
