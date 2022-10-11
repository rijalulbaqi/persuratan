<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use QrCode;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use App\Models\Pengaturan;



class KepsekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['active']=1;
        $user = Auth::user();
        $pengguna = User::all();
        $suratmasuk = SuratMasuk::all();
        $suratkeluar = SuratKeluar::where('nomor_surat','!=','reset')->get();
        return view('kepsek.home',$data, compact('user','pengguna','suratmasuk','suratkeluar'));
    }
    public function ubahpassword()
    {
        $data['active']=6;
        $user = Auth::user();
        return view('kepsek.ubah-password',$data, compact('user'));
    }
    public function simpanpassword(Request $request){
        $auth = Auth::user();
        $user = User::findOrFail($auth->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('kepsek/ubahpassword')->with('success','Password berhasil diganti!');
    }

 
    // Controller Menu pengguna
    public function pengguna()
    {
        $data['active']=2;
        $user = Auth::user();
        return view('kepsek.pengguna.index',$data, compact('user'));
    }
    public function datatablepengguna(){
    $model = User::orderBy('created_at','desc');;
    return DataTables::eloquent($model)
    ->addColumn('foto', function($row){
                $btn = $row->foto;
                return $btn;

        })
    ->rawColumns(['foto'])
    ->addIndexColumn()
    ->toJson();
    }

    // Controller Menu surat masuk
    public function suratmasuk()
    {
        $data['active']=3;
        $user = Auth::user();
        return view('kepsek.suratmasuk.index',$data, compact('user'));
    }
    public function datatablesuratmasuk(){
    $model = SuratMasuk::orderBy('created_at','desc');;
    return DataTables::eloquent($model)
    ->addColumn('file', function($row){
                $url = url('file/suratmasuk',$row->file_surat);
                $btn = '
                            <a target="_blank" href="'.$url.'" class="btn btn-primary btn-sm edit">
                            <i class="fas fa-print"></i>
                            </a>  
                            ';
                return $btn;

        })
    ->rawColumns(['file'])
    ->addIndexColumn()
    ->toJson();
    }

    // Controller Menu surat keluar
    public function suratkeluar()
    {
        $data['active']=4;
        $user = Auth::user();
        return view('kepsek.suratkeluar.index',$data, compact('user'));
    }
    public function datatablesuratkeluar(){
    $model = SuratKeluar::where('nomor_surat','!=','reset')->orderBy('created_at','desc');
    return DataTables::eloquent($model)
    ->addColumn('file', function($row){
                $url = url('file/suratkeluar',$row->file_surat);
                $btn = '
                            <a target="_blank" href="'.$url.'" class="btn btn-primary btn-sm edit">
                            <i class="fas fa-print"></i>
                            </a>  
                            ';
                return $btn;

        })
    ->addColumn('nomor', function($row){
                $datem = Carbon::createFromFormat('Y-m-d', $row->tanggal_surat)->format('m');
                $datey = Carbon::createFromFormat('Y-m-d', $row->tanggal_surat)->format('Y');
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
                
                $btn = "0".$row->nomor_surat.".0".$row->jenis_surat."/".$row->perihal."/SMKS.RQ/".$bulan."/".$datey;
                return $btn;
        })
    ->rawColumns(['file','nomor'])
    ->addIndexColumn()
    ->toJson();
    }

}
