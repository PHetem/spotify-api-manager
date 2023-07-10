<?php

namespace Database\Seeders\Media;

use App\Models\Customer\Customer;
use App\Models\Media\TopArtist;
use Database\Factories\Media\TopArtistFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            TopArtist::factory(10)->create(['customerID' => $customer->id]);
        }
    }
}
