<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Nour',
            'email' => 'nour@example.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        User::create([
            'username' => 'bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        User::create([
            'username' => 'alice',
            'email' => 'alice@example.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
    }
}
