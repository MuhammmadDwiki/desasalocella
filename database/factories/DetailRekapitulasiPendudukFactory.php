<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailRekapitulasi>
 */
class DetailRekapitulasiPendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id_detail_rekap"=> fake()->uuid(),
            "id_rekap" => "1",
            "id_rt" => "01",
            "kelompok_umur" => fake()->randomElement(['0-5', '6-12', '13-17', '18-25', '26-35', '36-45', '46-55', '56+']),
            "jumlah_laki_laki_awal" => fake()->numberBetween(0, 100),
            "jumlah_perempuan_awal" => fake()->numberBetween(0, 100),
            "jumlah_laki_laki_akhir" => fake()->numberBetween(0, 100),
            "jumlah_perempuan_akhir" => fake()->numberBetween(0, 100),
            "jumlah_laki_laki_pindah" => fake()->numberBetween( 0, 50),
            "jumlah_perempuan_pindah" => fake()->numberBetween(0, 50),
            "jumlah_laki_laki_datang" => fake()->numberBetween(0, 50),
            "jumlah_perempuan_datang" => fake()->numberBetween(0, 50),
        
            
        ];
    }
}
