<?php

namespace Database\Seeders\Media;

use App\Models\Customer\Customer;
use App\Models\Media\Playlist;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            Playlist::factory(rand(5, 20))->create(['customerID' => $customer->id]);
        }
    }
}
