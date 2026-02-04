<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Seed the super admin user.
     */
    public function run(): void
    {
        // Check if super admin already exists
        if (User::where('role', 'super_admin')->exists()) {
            $this->command->info('Super admin already exists. Skipping...');
            return;
        }

        User::create([
            'username' => 'admin',
            'name' => 'Admin Desa Salo Cella',
            'email' => 'admin@salocella.com',
            'password' => bcrypt(env('SUPER_ADMIN_PASSWORD', '12345678')),
            'role' => 'super_admin',
            'id_rt' => null,
            'email_verified_at' => now(),
            'last_login' => now(),
        ]);

        $this->command->info('Super admin created successfully!');
    }
}
