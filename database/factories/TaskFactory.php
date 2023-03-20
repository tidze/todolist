<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand_start = mt_rand(1655110660,1694110660);
        $rand_end = mt_rand($rand_start,1694110660);
        return [
            'category_id' => 1,
            'desired_duration' => 0,
            'starting_time' => $rand_start,
            'ending_time' => $rand_end,
        ];
    }
}
