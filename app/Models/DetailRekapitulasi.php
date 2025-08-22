<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class DetailRekapitulasi extends Model
{
        /** @use HasFactory<\Database\Factories\DetailRekapitulasiPendudukFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_detail_rekap'; // Tambahkan ini
    public $incrementing = false; // Jika ID bukan auto-increment
    protected $keyType = 'string'; // Jika ID bertipe string

    // public function rekapitulasiPenduduk()
    // {
    //     return $this->belongsTo(RekapitulasiPenduduk::class, 'id_rekap');
    // }
    public function rekapitulasi()
    {
        return $this->belongsTo(RekapitulasiPenduduk::class, 'id_rekap', 'id_rekap');
    }

    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt', 'id_rt');
    }
    public function rekapitulasiRT()
    {
        return $this->belongsTo(RekapitulasiRT::class, 'id_rekap_rt', 'id_rekap_rt');
    }
}
