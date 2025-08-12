<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KarangTaruna extends Model
{
    protected $primaryKey ='id_karangtaruna';
    public $incrementing = false; // Penting untuk UUID/string ID
    protected $keyType = 'string'; // Kunci sebagai string
    
    protected $guarded = [];



}
