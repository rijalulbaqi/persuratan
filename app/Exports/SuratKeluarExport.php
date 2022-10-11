<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use App\Models\Pengaturan;
use App\Models\Perihal;
use App\Models\JenisSurat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class SuratKeluarExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        // $suratkeluar = SuratKeluar::whereYear('tanggal_surat', '=', $request->tahun)->whereMonth('tanggal_surat', '=', $request->bulan)->where('jenis_surat', "=", $jenis1)->orderBy('tanggal_surat','asc')->get();
        // // foreach($suratkeluar as $suratkeluar){
            

        //         return [
        //        'nomor_surat' => $nomor,
        //        'jenis_surat' => $keluar->jenis_surat,
        //        'tanggal_surat' => $suratkeluar->tanggal_surat,
        //        'perihal' => $keluar->perihal,               
        //        'tujuan_surat' => $keluar->tujuan_surat,
        //     ];
        // }

        return SuratKeluar::whereYear('tanggal_surat', '=', $request->tahun)->whereMonth('tanggal_surat', '=', $request->bulan)->where('jenis_surat', "=", $request->jenis_surat)->orderBy('tanggal_surat','asc')->get()->map(function($suratkeluar) {
                    $pengaturan = Pengaturan::findOrFail(1);
                    $perihal = Perihal::where('kode',$suratkeluar->perihal)->first();
                    $jenis = JenisSurat::where('kode_surat',$suratkeluar->jenis_surat)->first();
                    $datem = Carbon::createFromFormat('Y-m-d', $suratkeluar->tanggal_surat)->format('m');
                    $datey = Carbon::createFromFormat('Y-m-d', $suratkeluar->tanggal_surat)->format('Y');

                    switch ($datem){
                        case 1:
                            $bulan = "I";
                            break;
                        case 2:
                            $bulan = "II";
                            break;
                        case 3:
                            $bulan = "III";
                            break;
                        case 4:
                            $bulan = "IV";
                            break;
                        case 5:
                            $bulan = "V";
                            break;
                        case 6:
                            $bulan = "VI";
                            break;
                        case 7:
                            $bulan = "VII";
                            break;
                        case 8:
                            $bulan = "VIII";
                            break;
                        case 9:
                            $bulan = "IX";
                            break;
                        case 10:
                            $bulan = "X";
                            break;
                        case 11:
                            $bulan = "XI";
                            break;
                        case 12:
                            $bulan = "XII";
                            break;
                  }
                    
                    $nomor = "0".$suratkeluar->nomor_surat.".0".$suratkeluar->jenis_surat."/".$suratkeluar->perihal."/".$pengaturan->kode_lembaga."/".$bulan."/".$datey;
            return [
               'nomor_surat' => $nomor,
               'jenis_surat' => $jenis->jenis_surat,
               'tanggal_surat' => $suratkeluar->tanggal_surat,
               'perihal' => $perihal->perihal,               
               'tujuan_surat' => $suratkeluar->tujuan_surat,
            ];
         });
    }
    public function headings(): array{
        return[
            'Nomor Surat',
            'Jenis Surat',
            'Tanggal Surat',
            'Perihal',
            'Tujuan Surat',
        ];
    }
}
