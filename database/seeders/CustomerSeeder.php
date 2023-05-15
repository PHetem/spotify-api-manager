<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Lucas Medeiros',
                'email' => 'lucas@mail.com',
                'accessToken' => Str::random(10),
                'refreshToken' => Str::random(10)
            ],[
                'name' => 'Felipe Medeiros',
                'email' => 'felipe@mail.com',
                'accessToken' => Str::random(10),
                'refreshToken' => Str::random(10)
            ],[
                'name' => 'Fernanda souza',
                'email' => 'fernanda@mail.com',
                'accessToken' => Str::random(10),
                'refreshToken' => Str::random(10)
            ],
        ];

        foreach ($data as $customer) {
            if (Customer::where('email', '=', $customer['email'])->count()) {
                $user = Customer::where('email', '=', $customer['email'])->first();
                $user->update($customer);
                echo 'User with email ' . $customer['email'] . ' updated' . PHP_EOL;
            } else {
                Customer::create($customer);
                echo 'User with email ' . $customer['email'] . ' created' . PHP_EOL;
            }
        }
    }
}
