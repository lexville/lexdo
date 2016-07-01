<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $faker = Faker::create();
        $users = [];
        foreach (range(1, 3) as $index)
        {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret')
            ];
        }
        DB::table('users')->insert($users);
    }
}
