<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class DetailRekapitulasi extends Model
{
        /** @use HasFactory<\Database\Factories\DetailRekapitulasiPendudukFactory> */
    use HasFactory, Notifiable;
    protected $guarded = [];
     protected $primaryKey = 'id_detail_rekap'; // Tambahkan ini
    public $incrementing = false; // Jika ID bukan auto-increment
    protected $keyType = 'string'; // Jika ID bertipe string

    // public function rekapitulasiPenduduk()
    // {
    //     return $this->belongsTo(RekapitulasiPenduduk::class, 'id_rekap');
    // }
}
