<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RekapitulasiPenduduk; // Ensure you import the model if it exists

class RekapitulasiPendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RekapitulasiPenduduk::factory()->create();
    }
}
