<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
     use HasFactory; 

    protected $guarded = [];
    protected $primaryKey = 'id_berita'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
