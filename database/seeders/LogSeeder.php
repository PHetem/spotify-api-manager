<?php

namespace Database\Seeders;

use App\Models\Log;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'userID' => 1,
                'action' => 'Login',
            ],[
                'userID' => 1,
                'action' => 'Logout',
            ],[
                'userID' => 2,
                'action' => 'Delete user: Fernanda Cabral',
            ],
        ];

        foreach ($data as $log) {
            Log::create($log);
            echo 'Log with action ' . $log['action'] . ' created'  . PHP_EOL;
        }
    }
}
