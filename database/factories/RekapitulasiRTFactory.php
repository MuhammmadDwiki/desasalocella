<?php

namespace Database\Factories;

use App\Models\RekapitulasiRT;
use App\Models\RekapitulasiPenduduk;
use App\Models\RT;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RekapitulasiRT>
 */
class RekapitulasiRTFactory extends Factory
{
    protected $model = RekapitulasiRT::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_rekap_rt' => 'RRT-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            'id_rekap' => RekapitulasiPenduduk::factory(),
            'id_rt' => RT::factory(),
            'jumlah_kk' => fake()->numberBetween(20, 100),
            'jumlah_penduduk_akhir' => fake()->numberBetween(80, 400),
            'status' => 'draft',
            'catatan_validasi' => null,
            'submitted_by' => User::factory(),
            'submitted_at' => null,
            'validated_at' => null,
        ];
    }

    /**
     * Status: draft (default, but explicit)
     */
    public function draft(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'draft',
            'submitted_at' => null,
            'validated_at' => null,
        ]);
    }

    /**
     * Status: pending (submitted for review)
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
            'submitted_at' => now(),
            'validated_at' => null,
        ]);
    }

    /**
     * Status: approved
     */
    public function approved(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'approved',
            'submitted_at' => now()->subDay(),
            'validated_at' => now(),
        ]);
    }

    /**
     * Status: rejected
     */
    public function rejected(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'rejected',
            'submitted_at' => now()->subDay(),
            'validated_at' => now(),
            'catatan_validasi' => fake()->sentence(),
        ]);
    }
}
