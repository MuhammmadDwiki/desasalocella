<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class RekapitulasiPenduduk extends Model
{
    /** @use HasFactory<\Database\Factories\RekapitulasiPendudukFactory> */
    use HasFactory, Notifiable;
    protected $guarded =[];

    // public function rt()
    // {
    //     return $this->belongsTo(Rt::class, 'id_rt');
    // }
}
