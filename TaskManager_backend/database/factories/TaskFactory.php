<?php

namespace Database\Factories;

use App\Models\TaskCategory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


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

        // date('Y-m-d H:i:s', $val);

        return [
            'unique_id' => Str::uuid(),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'due_date' =>  Carbon::now()->subDays(rand(0, 7))->format('Y-m-d'),
            'category_id' => rand(1, 10),
            'status' => 'Pending',
        ];
    }
}