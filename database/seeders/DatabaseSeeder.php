<?php

namespace Database\Seeders;

use App\Models\RekapitulasiPenduduk;
use App\Models\RT;
use App\Models\User;
use App\Models\DetailRekapitulasi;
use Database\Factories\RekapitulasiPendudukFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'Admin Desa',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'), // Use bcrypt for password hashing
            'role' => 'super_admin', // Set role to admin
            'id_rt' => null, // Example RT assignment
            'email_verified_at' => now(),
            'last_login' => now(),

        ]
        );

        // \App\Models\Berita::factory()->count(10)->create();
        // User::create([
        //     'username' => 'username moderator',
        //     'name' => 'moderator name',
        //     'email' => 'admin@desa.com',
        //     'password' => bcrypt('@Amway123'), // Use bcrypt for password hashing
        //     'role' => 'moderator', // Set role to admin
        //     'id_rt' => null, // Example RT assignment
        //     'email_verified_at' => now(),
        //     'last_login' => now(),

        // ]
        // );
        
        // RT::create([
        //     'id_rt' => '01',
        //     'nama_rt' => 'mariadi',
        //     "nomor_rt" => "01",
        //     'alamat_rt' => 'Alamat RT 01',
        //     "is_active" => true,
        // ]);
        // User::factory(10)->create();
        // RekapitulasiPenduduk::factory(1)->create();
        // DetailRekapitulasi::create([
        //     "id_detail_rekap"=> fake()->uuid(),
        //     "id_rekap" => "1",
        //     "id_rt" => "01",
        //     "kelompok_umur" => fake()->randomElement(['0-5', '6-12', '13-17', '18-25', '26-35', '36-45', '46-55', '56+']),
        //     "jumlah_laki_laki_awal" => fake()->numberBetween(0, 100),
        //     "jumlah_perempuan_awal" => fake()->numberBetween(0, 100),
        //     "jumlah_laki_laki_akhir" => fake()->numberBetween(0, 100),
        //     "jumlah_perempuan_akhir" => fake()->numberBetween(0, 100),
        //     "jumlah_laki_laki_pindah" => fake()->numberBetween( 0, 50),
        //     "jumlah_perempuan_pindah" => fake()->numberBetween(0, 50),
        //     "jumlah_laki_laki_datang" => fake()->numberBetween(0, 50),
        //     "jumlah_perempuan_datang" => fake()->numberBetween(0, 50),
        
            
        // ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
