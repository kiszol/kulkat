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
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@kulkat.hu',
            'password' => bcrypt('password123'),
        ]);

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@kulkat.hu',
            'password' => bcrypt('password123'),
        ]);
    }
}
