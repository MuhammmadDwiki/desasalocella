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
            'username' => 'admin',
            'name' => 'Admin Desa',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'), // Use bcrypt for password hashing
            'role' => 'Super Admin', // Set role to admin
            'assignedRT' => 'Semua RT', // Example RT assignment
            'email_verified_at' => now(),
            'last_login' => now(),

        ]
        );
        // User::factory(10)->create(); // Create 10 additional users using the factory

    }
}
