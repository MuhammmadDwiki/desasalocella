<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RekapitulasiPenduduk>
 */
class RekapitulasiPendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id_rekap" => 1,
            "bulan" => fake()->monthName(),
            "tahun" => fake()->year($max = 'now'),
            
        ];
    }
}
