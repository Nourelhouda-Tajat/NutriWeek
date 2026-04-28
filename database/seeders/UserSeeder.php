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
            'email' => 'nour@nutriweek.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        User::create([
            'username' => 'bob',
            'email' => 'bob@nutriweek.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        User::create([
            'username' => 'alice',
            'email' => 'alice@nutriweek.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
        User::create([
            'username' => 'admin',
            'email' => 'admin@nutriweek.com',
            'password' => bcrypt('password'),
            'role' => 'admin', 
        ]);
    }
}
