<?php

namespace Database\Seeders\Media;

use App\Models\Customer\Customer;
use App\Models\Media\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            Track::factory(rand(5, 20))->create(['customerID' => $customer->id]);
        }
    }
}
