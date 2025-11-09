<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bpd extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id_bpd'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
}
