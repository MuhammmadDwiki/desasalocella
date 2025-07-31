<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapitulasiPenduduk extends Model
{
    protected $guarded =[];

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'id_rt');
    }
}
