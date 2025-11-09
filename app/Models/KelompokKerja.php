<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelompokKerja extends Model
{
    use HasFactory;

    protected $table = 'kelompok_kerjas';
    protected $primaryKey = 'id_kelompok_kerja';
    
    protected $fillable = [
        'nama_kelompok_kerja',
    ];

    public function pkks()
    {
        return $this->hasMany(Pkk::class, 'kelompok_kerja', 'nama_kelompok_kerja');
    }
}
