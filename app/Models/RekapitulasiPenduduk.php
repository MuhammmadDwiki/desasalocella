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

    protected $primaryKey = 'id_rekap'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
    // public function detailRekapitulasi()
    // {
    //     return $this->hasMany(DetailRekapitulasi::class, 'id_rekap', 'id_rekap');
    // }
     public function rekapitulasiRTs()
    {
        return $this->hasMany(RekapitulasiRT::class, 'id_rekap', 'id_rekap');
    }
  
 

}
