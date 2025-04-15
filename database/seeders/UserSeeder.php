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
        DB::table('users')->updateOrInsert(
            ['email' => 'test@example.com'],
            [
                'username' => 'testuser',
                'password' => Hash::make('password123'),
                'first_name' => 'Test',
                'last_name' => 'User',
                'contact_number' => '1234567890',
                'isAdmin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@naxum.com'],
            [
                'username' => 'naxumadmin',
                'password' => Hash::make('admin123'),
                'first_name' => 'Admin',
                'last_name' => 'Naxum',
                'contact_number' => '0000000000',
                'isAdmin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}