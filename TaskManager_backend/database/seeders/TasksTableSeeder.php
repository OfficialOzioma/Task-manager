<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all users
        $users = User::all();

        // loop through each user
        foreach ($users as $user) {
            // determine how many tasks to create for the user
            $limit = random_int(10, 20);

            // create a new task until the limit is hit
            for ($i = 0; $i < $limit; $i++) {
                // make a new random task

                $task =  Task::factory()->make();

                // associate the task to the user and category
                $task->user()->associate($user);

                // save the task
                $task->save();
            }
        }
    }
}