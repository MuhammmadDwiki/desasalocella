<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    
    protected $guarded = [];
    protected $primaryKey = 'id_prDesa'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
}
