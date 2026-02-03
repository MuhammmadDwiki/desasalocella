<?php

namespace Database\Factories;

use App\Models\DetailRekapitulasi;
use App\Models\RekapitulasiRT;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailRekapitulasi>
 */
class DetailRekapitulasiFactory extends Factory
{
    protected $model = DetailRekapitulasi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $laki = fake()->numberBetween(5, 20);
        $perempuan = fake()->numberBetween(5, 20);

        return [
            'id_detail_rekap' => 'DR-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            'id_rekap_rt' => RekapitulasiRT::factory(),
            'kelompok_umur' => fake()->randomElement(['0-5', '6-12', '13-17', '18-25', '26-35', '36-45', '46-55', '56-65', '65+']),
            'jumlah_kk' => fake()->numberBetween(5, 30),
            'jumlah_laki_laki_awal' => $laki,
            'jumlah_perempuan_awal' => $perempuan,
            'jumlah_laki_laki_akhir' => $laki + fake()->numberBetween(-2, 3),
            'jumlah_perempuan_akhir' => $perempuan + fake()->numberBetween(-2, 3),
            'jumlah_laki_laki_pindah' => fake()->numberBetween(0, 2),
            'jumlah_perempuan_pindah' => fake()->numberBetween(0, 2),
            'jumlah_laki_laki_datang' => fake()->numberBetween(0, 3),
            'jumlah_perempuan_datang' => fake()->numberBetween(0, 3),
        ];
    }

    /**
     * Set specific age group
     */
    public function ageGroup(string $group): static
    {
        return $this->state(fn(array $attributes) => [
            'kelompok_umur' => $group,
        ]);
    }
}
