<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;  

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';
    protected $fillable = [
        'kode_surat',
        'jenis_surat',
    ];
    public function suratkeluar(){
        return $this->HasMany('App\Models\SuratKeluar');
    }
}