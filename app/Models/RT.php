<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $primaryKey = 'id_rt';
    public $incrementing = false; // Penting untuk UUID/string ID
    protected $keyType = 'string'; // Kunci sebagai string
    
    protected $guarded = [];

    protected $casts = [
        'id_rt' => 'string', 
        'nomor_rt' => 'string', // Pastikan tetap string
        'is_active' => 'boolean', // Konversi 1/0 ke true/false
        'nomor_hp' => 'string'
    ];
}
