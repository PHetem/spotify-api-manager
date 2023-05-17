<?php

namespace Database\Seeders\Media;

use App\Models\Customer\Customer;
use App\Models\Media\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            Artist::factory(rand(5, 20))->create(['customerID' => $customer->id]);
        }
    }
}
