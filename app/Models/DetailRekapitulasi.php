<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRekapitulasi extends Model
{
    protected $guarded = [];

    public function rekapitulasiPenduduk()
    {
        return $this->belongsTo(RekapitulasiPenduduk::class, 'id_rekap');
    }
}
