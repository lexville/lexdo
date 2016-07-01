<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->truncate();
        $faker = Faker::create();
        $tasks = [];
        foreach (range(1, 20) as $index)
        {
            $tasks[] = [
                'task' => $faker->name,
                'description' => $faker->text,
                'done' => false,
                'user_id' => rand(1, 3),
                'created_at' => $faker->dateTime
            ];
        }
        DB::table('tasks')->insert($tasks);
    }
}
