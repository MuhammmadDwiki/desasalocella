<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class RekapitulasiRT extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $primaryKey = 'id_rekap_rt'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'id_rekap_rt',
        'id_rekap',
        'id_rt',
        'jumlah_kk',
        'jumlah_penduduk_akhir',
        'status',
        'catatan_validasi',
        'submitted_by',
        'submitted_at',
        'validated_at',
    ];
    protected $casts = [
    'submitted_at' => 'datetime',
    'validated_at' => 'datetime',
];

    public function rekapitulasi()
    {
        return $this->belongsTo(RekapitulasiPenduduk::class, 'id_rekap', 'id_rekap');
    }

    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt', 'id_rt');
    }

    public function detailRekapitulasi()
    {
        return $this->hasMany(DetailRekapitulasi::class, 'id_rekap_rt', 'id_rekap_rt');
    }
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

}
