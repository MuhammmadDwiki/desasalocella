<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Always create super admin (idempotent - won't duplicate)
        $this->call(SuperAdminSeeder::class);

        // // Only seed fake data in non-production environments
        // if (!app()->environment('production')) {
        //     $this->command->info('Seeding fake data for testing...');

        //     // Create 10 fake news articles
        //     \App\Models\Berita::factory()->count(10)->create();

        //     $this->command->info('Fake data seeded!');
        // }
    }
}
