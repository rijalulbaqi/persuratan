<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;  

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_terima',
        'asal_surat',
        'perihal',
        'file_surat',
        'penerima',
    ];
    
}