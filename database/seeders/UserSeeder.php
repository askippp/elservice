<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'operator',
                'email' => 'operator@example.com',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi',
                'email' => 'teknisi@example.com',
                'password' => Hash::make('password'),
                'role' => 'teknisi',
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'customer',
                'email' => 'customer@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
