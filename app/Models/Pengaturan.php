<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;  

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    protected $fillable = [
        'nama_lembaga',
        'kode_lembaga',
        'kepala_lembaga',
        'nip',
        'kop_surat',
    ];
    
}