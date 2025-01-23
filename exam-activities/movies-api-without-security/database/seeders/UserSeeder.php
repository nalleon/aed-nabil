<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'nabil',
            'email' => 'nabil14716@gmail.com',
            'email_verified_at' => null, 
            'password' => Hash::make('1q2w3e4r'), 
            'remember_token' => null,
            'role' => 'user',
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('1q2w3e4r'),
            'remember_token' => null,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
