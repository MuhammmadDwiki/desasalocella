<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'id_rt',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
     public function berita()
    {
        return $this->hasMany(Berita::class, 'id_user');
    }
    
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }


    public function isModerator()
    {
        return $this->role === 'moderator' || $this->isAdmin();
    }

    public function hasRole($role)
    {
        return $this->role === $role || $this->isSuperAdmin();
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt', 'id_rt');
    }
    public function getResponsibleRT()
    {
        if ($this->isSuperAdmin()) {
            return RT::all(); // Super admin bisa akses semua RT
        }
        
        return $this->rt; // Moderator hanya akses RT nya sendiri
    }

    public function isResponsibleForRT($rtId)
    {
        if ($this->isSuperAdmin()) return true;
        
        return $this->id_rt === $rtId;
    }


    public function can($ability, $arguments = [])
    {

        if ($this->isSuperAdmin()) {
            return true;
        }

        $permissions = [
            'moderator' => [
                'laporan-bulanan.create',
                'laporan-bulanan.view',
                'laporan-bulanan.update',
                'laporan-bulanan.delete',
                'kegiatan.create',
                'kegiatan.view', 
                'kegiatan.update',
                'kegiatan.delete',
                'agama.create',
                'agama.view',
                'agama.update', 
                'agama.delete',
                'karang-taruna.create',
                'karang-taruna.view',
                'karang-taruna.update',
                'karang-taruna.delete',
                'rekapitulasi-rt.submit'
            ]
        ];

        return in_array($ability, $permissions[$this->role] ?? []);
    }
}
