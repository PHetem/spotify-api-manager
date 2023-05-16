<?php

namespace Database\Seeders;

use App\Models\Customer\Customer;
use App\Models\Customer\Podcast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PodcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            Podcast::factory(rand(5, 20))->create(['customerID' => $customer->id]);
        }
    }
}
