<?php

namespace App\Policies;

use App\Models\RekapitulasiPenduduk;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RekapitulasiPendudukPolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin() || $user->isModerator();
    }

    public function view(User $user, RekapitulasiPenduduk $laporan)
    {
        if ($user->isSuperAdmin()) return true;

        // Moderator hanya bisa melihat laporan untuk RT mereka
        // Cek melalui detail rekapitulasi
        return $user->isResponsibleForRT($laporan->detail->id_rt ?? null);
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isModerator();
    }

    public function update(User $user, RekapitulasiPenduduk $laporan)
    {
        if ($user->isSuperAdmin()) return true;

        // Moderator hanya bisa edit laporan untuk RT mereka
        // yang masih draft/pending
        return $user->isResponsibleForRT($laporan->detail->id_rt ?? null) &&
            in_array($laporan->status, ['draft', 'pending']);
    }

    public function delete(User $user, RekapitulasiPenduduk $laporan)
    {
        if ($user->isSuperAdmin()) return true;

        return $user->isResponsibleForRT($laporan->detail->id_rt ?? null);
    }

    
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RekapitulasiPenduduk $rekapitulasiPenduduk): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RekapitulasiPenduduk $rekapitulasiPenduduk): bool
    {
        return false;
    }
}
