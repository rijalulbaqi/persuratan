<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SuratMasukExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $request;
    
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        $request = $this->request;  
        return SuratMasuk::whereYear('tanggal_surat', '=', $request->tahun)->whereMonth('tanggal_surat', '=', $request->bulan)->orderBy('tanggal_surat','asc')->get()->map(function($suratmasuk) {
            return [
               'nomor_surat' => $suratmasuk->nomor_surat,
               'tanggal_surat' => $suratmasuk->tanggal_surat,
               'tanggal_terima' => $suratmasuk->tanggal_terima,
               'asal_surat' => $suratmasuk->asal_surat,
               'perihal' => $suratmasuk->perihal,
               'penerima' => $suratmasuk->penerima,               
            ];
         });
    }
    public function headings(): array{
        return[
            'Nomor Surat',
            'Tanggal Surat',
            'Tanggal Terima',
            'Asal Surat',
            'Perihal',
            'Penerima',
        ];
    }
}
