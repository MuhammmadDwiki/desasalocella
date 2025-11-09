<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pkk extends Model
{
    protected $primaryKey ='id_pkk';
    public $incrementing = false; // Penting untuk UUID/string ID
    protected $keyType = 'string'; // Kunci sebagai string
    protected $guarded = [];

    
}
