<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userID' => User::all()->random()->id,
            'action' => fake()->randomElement(['Login', 'Logout', 'View Users', 'View Logs', 'User Viewed: ' . rand(1,10), 'User Deleted: ' . rand(1,10)])
        ];
    }
}
