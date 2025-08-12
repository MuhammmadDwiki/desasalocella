<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $primaryKey = 'id_agama';
    public $incrementing = false; // Penting untuk UUID/string ID
    protected $keyType = 'string'; // Kunci sebagai string
    
    protected $guarded = [];
    protected $casts = [
        'jumlah_penduduk' => 'string', 
    ];
}
