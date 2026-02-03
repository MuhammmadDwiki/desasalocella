<?php

namespace Database\Factories;

use App\Models\RT;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RT>
 */
class RTFactory extends Factory
{
    protected $model = RT::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_rt' => 'RT-' . now()->format('YmdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
            'nomor_rt' => fake()->unique()->numberBetween(1, 20),
            'nama_rt' => fake()->name(),
            'jumlah_kk' => fake()->numberBetween(20, 100),
            'jumlah_penduduk' => fake()->numberBetween(80, 400),
            'is_active' => 1, // Active by default
        ];
    }

    /**
     * Indicate that the RT is inactive
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => 0,
        ]);
    }
}
