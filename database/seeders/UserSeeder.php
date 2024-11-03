<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin user
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin1@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'admin',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Customer user
        DB::table('users')->insert([
            'name' => 'Customer User',
            'email' => 'customer1@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'customer',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
