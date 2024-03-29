<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create(
            [
                'name' => 'Yigit Ozdemir',
                'email' => 'yigit@yigitnot.com',
                'password'=> bcrypt('123456')
            ]
        );

        \App\Models\User::factory()->create(
            [
                'name' => 'Yigit Ozdemir',
                'email' => 'yigit2@yigitnot.com',
                'password'=> bcrypt('123456')
            ]
        );
    }
}
