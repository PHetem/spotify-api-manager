<?php

namespace Database\Seeders;

use App\Models\APIToken;
use App\Models\Customer\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class APITokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            APIToken::factory()->create([
                'customerID' => $customer->id,
                'type' => 'Refresh',
            ]);

            APIToken::factory()->create([
                'customerID' => $customer->id,
                'type' => 'Access',
            ]);
        }

        foreach (User::all() as $user) {
            APIToken::factory()->create([
                'userID' => $user->id,
                'type' => 'Access',
            ]);
        }
    }
}
