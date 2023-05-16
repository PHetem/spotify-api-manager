<?php

namespace Database\Seeders;

use App\Models\Podcast;
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
        $this->call(AlbumSeeder::class);
        $this->call(TrackSeeder::class);
    }
}
