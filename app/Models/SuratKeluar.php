<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;  

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';
    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'perihal',
        'lampiran',
        'isi',
        'tanggal_surat',
        'tujuan_surat',
        'file_surat',
        'jumlah_ttd',
        'ttd_1',
        'nama_1',
        'nip_1',
        'ttd_2',
        'nama_2',
        'nip_2',
        'ttd_3',
        'nama_3',
        'nip_3',
        'ttd_4',
        'nama_4',
        'nip_4',
    ];
    public function jenis(){
        return $this->BelongsTo('App\Models\JenisSurat','jenis_surat');
    }
    public function perihal(){
        return $this->HasOne('App\Models\Perihal','kode');
    }
}