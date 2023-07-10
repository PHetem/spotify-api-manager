<?php

namespace Database\Seeders\Media;

use App\Models\Customer\Customer;
use App\Models\Media\TopTrack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopTrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            TopTrack::factory(10)->create(['customerID' => $customer->id]);
        }
    }
}
