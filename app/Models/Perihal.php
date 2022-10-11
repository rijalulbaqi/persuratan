<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;  

class Perihal extends Model
{
    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $table = 'perihal';
    protected $fillable = [
        'kode',
        'perihal',
    ];
    public function suratkeluar(){
        return $this->BelongsTo('App\Models\SuratKeluar','perihal');
    }
}