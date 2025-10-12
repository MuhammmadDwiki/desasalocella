<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $judul = $this->faker->sentence(6);
        
        return [
            'id_berita' => 'BRT' . Str::padLeft($this->faker->unique()->numberBetween(1, 100), 3, '0'),
            'id_users' => '1',
            'judul_berita' => $judul,
            'isi_berita' => '<p>' . implode('</p><p>', $this->faker->paragraphs(3)) . '</p>',
            'url_gambar' => 'https://picsum.photos/seed/800/600',
            'slug' => Str::slug($judul),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    
    
    }
}
