<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\LaporanBulanan;
use App\Models\Kegiatan;
use App\Models\Agama;
use App\Models\KarangTaruna;
use App\Models\RT;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        // LaporanBulanan::class => LaporanBulananPolicy::class,
        // Kegiatan::class => KegiatanPolicy::class,
        // Agama::class => AgamaPolicy::class,
        // KarangTaruna::class => KarangTarunaPolicy::class,
        // RT::class => RTPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('super_admin', function (User $user) {
            return $user->isSuperAdmin();
        });
        Gate::define('moderator', function ($user) {
            return $user->role === 'moderator' || $user->role === 'super_admin';
        });

    }
}
