<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            Album::factory(rand(5, 20))->create(['customerID' => $customer->id]);
        }
    }
}
