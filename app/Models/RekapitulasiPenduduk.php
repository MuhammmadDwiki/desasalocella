<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class RekapitulasiPenduduk extends Model
{
    /** @use HasFactory<\Database\Factories\RekapitulasiPendudukFactory> */
    use HasFactory, Notifiable;
    protected $guarded = [];

    protected $primaryKey = 'id_rekap'; // Tambahkan ini
    public $incrementing = false; // Jika ID bukan auto-increment
    protected $keyType = 'string'; // Jika ID bertipe string
    public function details()
    {
        return $this->hasMany(DetailRekapitulasi::class, 'id_rekap', 'id_rekap');
    }
    // public function rt()
    // {
    //     return $this->belongsTo(Rt::class, 'id_rt');
    // }
}
