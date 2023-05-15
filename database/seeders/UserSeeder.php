<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'name' => 'ph',
            'email' => 'ph@mail.com',
            'password' => bcrypt('123456'),
            'isAdmin' => true,
            'deleted_at' => null
        ],[
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'isAdmin' => false,
            'deleted_at' => null
        ]];

        foreach ($data as $user) {
            if (User::where('email', '=', $user['email'])->withTrashed()->count()) {
                $obj = User::where('email', '=', $user['email'])->withTrashed()->first();
                $obj->update($user);
                echo 'User updated' . PHP_EOL;
            } else {
                User::create($user);
                echo 'User Created' . PHP_EOL;
            }
        }
    }
}
