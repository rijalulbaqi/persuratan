<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\JenisSurat;
use App\Models\Perihal;
use App\Models\Pengaturan;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratMasukExport;
use App\Exports\SuratKeluarExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use QrCode;
use Jenssegers\Date\Date;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use DB;
use Validator;
use Carbon\Carbon;



class AdminController extends Controller
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
        return view('admin.home',$data, compact('user','pengguna','suratmasuk','suratkeluar'));
    }
    public function ubahpassword()
    {
        $data['active']=5;
        $user = Auth::user();
        return view('admin.ubah-password',$data, compact('user'));
    }
    public function simpanpassword(Request $request){
        $auth = Auth::user();
        $user = User::findOrFail($auth->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('admin/ubahpassword')->with('success','Password berhasil diganti!');
    }

 
    // Controller Menu pengguna
    public function pengguna()
    {
        $data['active']=2;
        $user = Auth::user();
        return view('admin.pengguna.index',$data, compact('user'));
    }
    public function tambahpengguna(Request $request)
    {
        $data = new User;
        $data->name = $request->nama;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->role = "admin";
        $data->status = "1";
        $data->foto = "default.jpg";
        $data->save();

        return json_encode(1);
    }
    public function editpengguna($id)
    {
        $data['active']=2;
        $user = Auth::user();
        $iduser = Crypt::decryptString($id);
        $usr = User::findOrFail($iduser);
        return view('admin.pengguna.ubah-password',$data, compact('usr','user'));
    }
    public function ubahpasswordpengguna(Request $request){
        $user = User::findOrFail($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('editpengguna/'.Crypt::encryptString($request->id))->with('success','Password berhasil diganti!');
    }
    public function deletepengguna($id){
        $iduser = Crypt::decryptString($id);
        $user = User::findOrFail($iduser);
        $user->delete();
        return json_encode(1);
    }
    public function datatablepengguna(){
    $model = User::orderBy('created_at','desc');
    return DataTables::eloquent($model)
    ->addColumn('action', function($row){
                $user = Auth::user();
                if($user->id == "93" ){
                    if($row->role == "kepsek"){
                        $urlEdit = url('editpengguna',Crypt::encryptString($row->id));
                        $btn = '
                        <a href="'.$urlEdit.'" class="btn btn-primary btn-sm edit">
                        <i class="fas fa-pencil-alt"></i> Ubah Password
                        </a>
                        ';
                      
                        return $btn;
                    }   
                    elseif($row->id== "93"){
                        $urlEdit = url('editpengguna',Crypt::encryptString($row->id));
                        $btn = '
                        <a href="'.$urlEdit.'" class="btn btn-primary btn-sm edit">
                        <i class="fas fa-pencil-alt"></i> Ubah Password
                        </a>
                        ';
                      
                        return $btn;
                    }   
                    elseif($row->id != "93"){
                        $urlEdit = url('editpengguna',Crypt::encryptString($row->id));
                        $urlDelete = url('deletepengguna',Crypt::encryptString($row->id));
                        $btn = '
                        <a href="'.$urlEdit.'" class="btn btn-primary btn-sm edit">
                        <i class="fas fa-pencil-alt"></i> Ubah Password
                        </a>
                        <a href="'.$urlDelete.'" class="btn btn-danger btn-sm delete">
                        <i class="fas fa-trash"></i>
                        </a>
                        ';
                    
                        return $btn;
                    }
                }
                else{
                    return "";
                }   

        })
    ->rawColumns(['action'])
    ->addIndexColumn()
    ->toJson();
    }

    // Controller Menu surat masuk
    public function suratmasuk()
    {
        $data['active']=3;
        $user = Auth::user();
        $bulan = SuratMasuk::select(
                            "id" ,
                            DB::raw("(DATE_FORMAT(tanggal_surat, '%m')) as bulan")
                            )
                            ->orderBy('tanggal_surat')
                            ->groupBy(DB::raw("DATE_FORMAT(tanggal_surat, '%m')"))
                            ->get();
        $tahun = SuratMasuk::select(
                            "id" ,
                            DB::raw("(DATE_FORMAT(tanggal_surat, '%Y')) as tahun")
                            )
                            ->orderBy('tanggal_surat')
                            ->groupBy(DB::raw("DATE_FORMAT(tanggal_surat, '%Y')"))
                            ->get();
        return view('admin.suratmasuk.index',$data, compact('user','bulan','tahun'));
    }
    public function tambahsuratmasuk(Request $request)
    {
        $file       = $request->file('file_surat');
        if(($file->getClientOriginalExtension())!='pdf'){
            return redirect('admin/suratmasuk')->with('failed','File harus pdf!');
        };
        $dokumen       = time().$file->getClientOriginalName();
        $file->move("file/suratmasuk", $dokumen);
        $data = new SuratMasuk;
        $data->nomor_surat = $request->nomor_surat;
        $data->tanggal_surat = $request->tanggal_surat;
        $data->tanggal_terima = $request->tanggal_terima;
        $data->asal_surat = $request->asal_surat;
        $data->perihal = $request->perihal;
        $data->file_surat = $dokumen;
        $data->penerima = $request->penerima;
        $data->save();

        return redirect('admin/suratmasuk')->with('success','Berhasil menambah data!');
    }
    public function editsuratmasuk($id)
    {
        $data['active']=3;
        $user = Auth::user();
        $idsurat = Crypt::decryptString($id);
        $suratmasuk = SuratMasuk::findOrFail($idsurat);
        return view('admin.suratmasuk.edit',$data, compact('suratmasuk','user'));
    }
    public function showsuratmasuk($id)
    {
        $data['active']=3;
        $user = Auth::user();
        $idsurat = Crypt::decryptString($id);
        $suratmasuk = SuratMasuk::findOrFail($idsurat);
        return view('admin.suratmasuk.show',$data, compact('suratmasuk','user'));
    }
    public function filtersuratmasuk(Request $request)
    {
        $data['active']=3;
        $user = Auth::user();
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $suratmasuk = SuratMasuk::whereYear('tanggal_surat', '=', $request->tahun)->whereMonth('tanggal_surat', '=', $request->bulan)->orderBy('tanggal_surat','asc')->get();
        return view('admin.suratmasuk.filter', $data, compact('user','suratmasuk','bulan','tahun'));
    }
    public function exportsuratmasuk(Request $request)
    {
        return Excel::download(new SuratMasukExport($request), 'suratmasuk '.$request->bulan.$request->tahun.'.xlsx');
    }
    public function ubahsuratmasuk(Request $request){
        if($request->hasFile('file_surat')) {
            $filebaru       = $request->file('file_surat');
            $file       = time().$filebaru->getClientOriginalName();
            $filebaru->move("file/suratmasuk", $file);
            $suratmasuk = SuratMasuk::findOrFail($request->id);
            $suratmasuk->file_surat = $file;
            $suratmasuk->save();
        }
        $suratmasuk = SuratMasuk::findOrFail($request->id);
        $suratmasuk->nomor_surat = $request->nomor_surat;
        $suratmasuk->tanggal_surat = $request->tanggal_surat;
        $suratmasuk->tanggal_terima = $request->tanggal_terima;
        $suratmasuk->asal_surat = $request->asal_surat;
        $suratmasuk->perihal = $request->perihal;
        $suratmasuk->save();
        return redirect('admin/suratmasuk');
    }
    public function deletesuratmasuk($id){
        $idsurat = Crypt::decryptString($id);
        $suratmasuk = SuratMasuk::findOrFail($idsurat);
        $suratmasuk->delete();
        return json_encode(1);
    }
    public function datatablesuratmasuk(){
    $model = SuratMasuk::orderBy('created_at','desc');;
    return DataTables::eloquent($model)
    ->addColumn('action', function($row){
                    $urlEdit = url('editsuratmasuk',Crypt::encryptString($row->id));
                    $urlShow = url('showsuratmasuk',Crypt::encryptString($row->id));
                    $urlDelete = url('deletesuratmasuk',Crypt::encryptString($row->id));
                    $btn = '
                    <a href="'.$urlShow.'" class="btn btn-success btn-sm show">
                    <i class="fas fa-eye"></i>
                    </a>
                    <a href="'.$urlEdit.'" class="btn btn-primary btn-sm edit">
                    <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="'.$urlDelete.'" class="btn btn-danger btn-sm delete">
                    <i class="fas fa-trash"></i>
                    </a>
                    ';
                  
                    return $btn;

        })
    ->addColumn('file', function($row){
                $url = url('file/suratmasuk',$row->file_surat);
                $btn = '
                            <a target="_blank" href="'.$url.'" class="btn btn-primary btn-sm edit">
                            <i class="fas fa-print"></i>'.$row->nomor_surat.'
                            </a>  
                            ';
                return $btn;

        })
    ->addColumn('status', function($row){
                if($row->status=="Belum Dibaca"){
                    $btn = '<span class="badge badge-pill badge-primary">Belum Dibaca</span>';
                return $btn;
                }
                else if($row->status=="Sudah Dibaca"){
                    $btn = '<span class="badge badge-pill badge-success">Sudah Dibaca</span>';
                return $btn;
                }

        })
    ->rawColumns(['action','file','status'])
    ->addIndexColumn()
    ->toJson();
    }
    //pengaturan
    public function pengaturan()
    {
        $data['active']=4;
        $user = Auth::user();
        $p = Pengaturan::findOrFail(1);
        return view('admin.pengaturan.index',$data, compact('user','p'));
    }
    public function updatepengaturan(Request $request)
    {
        if($request->hasFile('kop_surat')) {
            $edit = Pengaturan::findOrFail('1');
            $filelawas =  $edit->kop_surat;
            $filebaru = $request->file('kop_surat');
            $filename = time().$filebaru->getClientOriginalName();
            $filebaru->move("img/", $filename);
            $edit ->kop_surat = $filename;
            $edit->save();
        }
        $ubah = Pengaturan::findOrFail(1);
        $ubah->nama_lembaga = $request->nama_lembaga;
        $ubah->kode_lembaga = $request->kode_lembaga;
        $ubah->kepala_lembaga = $request->kepala_lembaga;
        $ubah->nip = $request->nip;
        $ubah->save();
        return redirect('admin/pengaturan');
    }
    //jenis surat
    public function jenissurat()
    {
        $data['active']=4;
        $user = Auth::user();
        return view('admin.jenissurat.index',$data, compact('user'));
    }
    public function tambahjenissurat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_surat' => 'required|max:255',
            'jenis_surat' => 'required',
        ]);
        if ($validator->passes()) {
            $j = JenisSurat::where('kode_surat','=',$request->kode_surat)->first();
                if($j){
                    return json_encode(2);
                }
                else{
                    $data = new JenisSurat;
                    $data->kode_surat = $request->kode_surat;
                    $data->jenis_surat = $request->jenis_surat;
                    $data->save();
                    return json_encode(1);
                }
        }
        return json_encode(3);

    }
    public function editjenissurat($id)
    {
        $data['active']=4;
        $user = Auth::user();
        $idjenis = Crypt::decryptString($id);
        $jenissurat = JenisSurat::findOrFail($idjenis);
        return view('admin.jenissurat.edit',$data, compact('jenissurat','user'));
    }
    public function ubahjenissurat(Request $request){
        $jenissurat = JenisSurat::findOrFail($request->id);
        $jenissurat->kode_surat = $request->kode_surat;
        $jenissurat->jenis_surat = $request->jenis_surat;
        $jenissurat->save();
        return redirect('admin/jenissurat');
    }
    public function deletejenissurat($id){
        $idj = Crypt::decryptString($id);
        $jenis = JenisSurat::findOrFail($idj);
        $jenis->delete();
        return json_encode(1);
    }
    public function datatablejenissurat(){
    $model = JenisSurat::orderBy('created_at','desc');
    return DataTables::eloquent($model)
    ->addColumn('action', function($row){
                    $urlEdit = url('editjenissurat',Crypt::encryptString($row->id));
                    $urlDelete = url('deletejenissurat',Crypt::encryptString($row->id));
                    $btn = '
                    <a href="'.$urlEdit.'" class="btn btn-primary btn-sm edit">
                    <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="'.$urlDelete.'" class="btn btn-danger btn-sm delete">
                    <i class="fas fa-trash"></i>
                    </a>
                    ';
                  
                    return $btn;                   
        })
    ->rawColumns(['action'])
    ->addIndexColumn()
    ->toJson();
    }
    //perihal
    public function perihal()
    {
        $data['active']=4;
        $user = Auth::user();
        return view('admin.perihal.index',$data, compact('user'));
    }
    public function tambahperihal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|max:255',
            'perihal' => 'required',
        ]);
        if ($validator->passes()) {
            $j = Perihal::where('kode','=',$request->kode)->first();
                if($j){
                    return json_encode(2);
                }
                else{
                    $data = new perihal;
                    $data->kode = $request->kode;
                    $data->perihal = $request->perihal;
                    $data->save();
                    return json_encode(1);
                }
        }
        return json_encode(3);

    }
    public function editperihal($id)
    {
        $data['active']=4;
        $user = Auth::user();
        $idp = Crypt::decryptString($id);
        $perihal = Perihal::findOrFail($idp);
        return view('admin.perihal.edit',$data, compact('perihal','user'));
    }
    public function ubahperihal(Request $request){
        $perihal = Perihal::findOrFail($request->id);
        $perihal->kode = $request->kode;
        $perihal->perihal = $request->perihal;
        $perihal->save();
        return redirect('admin/perihal');
    }
    public function deleteperihal($id){
        $idj = Crypt::decryptString($id);
        $jenis = Perihal::findOrFail($idj);
        $jenis->delete();
        return json_encode(1);
    }
    public function datatableperihal(){
    $model = Perihal::orderBy('created_at','desc');
    return DataTables::eloquent($model)
    ->addColumn('action', function($row){
                    $urlEdit = url('editperihal',Crypt::encryptString($row->kode));
                    $urlDelete = url('deleteperihal',Crypt::encryptString($row->kode));
                    $btn = '
                    <a href="'.$urlEdit.'" class="btn btn-primary btn-sm edit">
                    <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="'.$urlDelete.'" class="btn btn-danger btn-sm delete">
                    <i class="fas fa-trash"></i>
                    </a>
                    ';
                  
                    return $btn;                   
        })
    ->rawColumns(['action'])
    ->addIndexColumn()
    ->toJson();
    }
    // Controller Menu surat keluar
    public function suratkeluar()
    {
        $data['active']=4;
        $user = Auth::user();
        $nomor = SuratKeluar::orderBy('created_at','desc')->first();
        $jenis = JenisSurat::all();
        $perihal = Perihal::all();
        $pengaturan = Pengaturan::findOrFail(1);
        $bulan = SuratKeluar::select(
                            "id" ,
                            DB::raw("(DATE_FORMAT(tanggal_surat, '%m')) as bulan")
                            )
                            ->orderBy('tanggal_surat')
                            ->where('nomor_surat','!=','reset')
                            ->groupBy(DB::raw("DATE_FORMAT(tanggal_surat, '%m')"))
                            ->get();
        $tahun = SuratKeluar::select(
                            "id" ,
                            DB::raw("(DATE_FORMAT(tanggal_surat, '%Y')) as tahun")
                            )
                            ->orderBy('tanggal_surat')
                            ->where('nomor_surat','!=','reset')
                            ->groupBy(DB::raw("DATE_FORMAT(tanggal_surat, '%Y')"))
                            ->get();
        return view('admin.suratkeluar.index',$data, compact('user','bulan','tahun','jenis','perihal','nomor','pengaturan'));
    }
    public function tambahsuratkeluar(Request $request)
    {
                    $data = new SuratKeluar;
                    $data->nomor_surat = $request->nomor_surat;
                    $data->jenis_surat = $request->jenis_surat;
                    $data->perihal = $request->perihal;
                    $data->lampiran = $request->lampiran;
                    $data->isi = $request->isi;
                    $data->tanggal_surat = $request->tanggal_surat;
                    $data->tujuan_surat = $request->tujuan_surat;
                    $data->jumlah_ttd = $request->jumlah_ttd;
                    $data->ttd_1 = $request->ttd_1;
                    $data->nama_1 = $request->nama_1;
                    $data->nip_1 = $request->nip_1;
                    $data->ttd_2 = $request->ttd_2;
                    $data->nama_2 = $request->nama_2;
                    $data->nip_2 = $request->nip_2;
                    $data->ttd_3 = $request->ttd_3;
                    $data->nama_3 = $request->nama_3;
                    $data->nip_3 = $request->nip_3;
                    $data->ttd_4 = $request->ttd_4;
                    $data->nama_4 = $request->nama_4;
                    $data->nip_4 = $request->nip_4;
                    $data->save();

        return redirect('admin/suratkeluar')->with('success','Berhasil menambah data!');
    }
    public function editsuratkeluar($id)
    {
        $data['active']=4;
        $user = Auth::user();
        $idsurat = Crypt::decryptString($id);
        $suratkeluar = SuratKeluar::findOrFail($idsurat);
        $jenislama = JenisSurat::where('kode_surat',$suratkeluar->jenis_surat)->first();
        $perihallama = Perihal::where('kode',$suratkeluar->perihal)->first();
        $jenis = JenisSurat::all();
        $perihal = Perihal::all();
        $pengaturan = Pengaturan::findOrFail(1);
        Date::setLocale('id');
        $tanggal = Carbon::createFromFormat('Y-m-d', $suratkeluar->tanggal_surat)->format('j F Y');
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
        return view('admin.suratkeluar.edit',$data, compact('suratkeluar','user','jenislama','perihallama','jenis','perihal','nomor'));
    }
    public function unggahsuratkeluar($id)
    {
        $data['active']=4;
        $user = Auth::user();
        $idsurat = Crypt::decryptString($id);
        $suratkeluar = SuratKeluar::findOrFail($idsurat);
        return view('admin.suratkeluar.upload',$data, compact('suratkeluar','user'));
    }
    public function uploadsuratkeluar(Request $request)
    {
        $file       = $request->file('file_surat');
        if(($file->getClientOriginalExtension())!='pdf'){
            return redirect('admin/uploadsuratkeluar/'.Crypt::encryptString($request->id))->with('failed','File harus pdf!');
        };
        $dokumen       = time().$file->getClientOriginalName();
        $file->move("file/suratkeluar", $dokumen);
        $data = SuratKeluar::findOrFail($request->id);
        $data->file_surat = $dokumen;
        $data->save();

        return redirect('admin/suratkeluar')->with('success','Berhasil upload!');
    }
    public function ubahsuratkeluar(Request $request){
        if($request->hasFile('file_surat')) {
            $filebaru       = $request->file('file_surat');
            $file       = time().$filebaru->getClientOriginalName();
            $filebaru->move("file/suratkeluar", $file);
            $suratkeluar = SuratKeluar::findOrFail($request->id);
            $suratkeluar->file_surat = $file;
            $suratkeluar->save();
        }
        $suratkeluar = SuratKeluar::findOrFail($request->id);
        $suratkeluar->nomor_surat = $request->nomor;
        $suratkeluar->tanggal_surat = $request->tanggal_surat;
        $suratkeluar->jenis_surat = $request->jenis_surat;
        $suratkeluar->tujuan_surat = $request->tujuan_surat;
        $suratkeluar->perihal = $request->perihal;
        $suratkeluar->lampiran = $request->lampiran;
        $suratkeluar->isi = $request->isi;
        $suratkeluar->save();
        return redirect('admin/suratkeluar');
    }
    public function filtersuratkeluar(Request $request)
    {
        $data['active']=4;
        $user = Auth::user();
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $jenis1 = $request->jenis_surat;
        $perihal = Perihal::all();
        $jenis = JenisSurat::where('kode_surat',$jenis1)->first();
        $jenissurat = JenisSurat::all();
        $pengaturan = Pengaturan::findOrFail(1);
        Date::setLocale('id');             
        $suratkeluar = SuratKeluar::where('jenis_surat', "=", $request->jenis_surat)->whereYear('tanggal_surat', '=', $request->tahun)->whereMonth('tanggal_surat', '=', $request->bulan)->orderBy('tanggal_surat','asc')->get();

        return view('admin.suratkeluar.filter', $data, compact('user','jenissurat','suratkeluar','bulan','tahun','jenis','pengaturan','perihal'));
    }
    public function exportsuratkeluar(Request $request)
    {
        $jenis = JenisSurat::where('kode_surat',$request->jenis_surat)->first();
        return Excel::download(new SuratKeluarExport($request), 'suratkeluar '.$request->bulan.$request->tahun.$jenis->jenis_surat.'.xlsx');
    }
    public function deletesuratkeluar($id){
        $idsurat = Crypt::decryptString($id);
        $suratkeluar = SuratKeluar::findOrFail($idsurat);
        $suratkeluar->delete();
        return json_encode(1);
    }
    public function resetnomor(){
        $suratkeluar = new SuratKeluar();
        $suratkeluar->nomor_surat = "reset";
        $suratkeluar->tanggal_surat = "";
        $suratkeluar->jenis_surat = "reset";
        $suratkeluar->perihal = "reset";
        $suratkeluar->isi = "reset";
        $suratkeluar->lampiran = "";
        $suratkeluar->tujuan_surat = "reset";
        $suratkeluar->file_surat = "";
        $suratkeluar->jumlah_ttd = "";
        $suratkeluar->ttd_1 = "";
        $suratkeluar->nama_1 = "";
        $suratkeluar->nip_1 = "";
        $suratkeluar->ttd_2 = "";
        $suratkeluar->nama_2 = "";
        $suratkeluar->nip_2 = "";
        $suratkeluar->ttd_3 = "";
        $suratkeluar->nama_3 = "";
        $suratkeluar->nip_3 = "";
        $suratkeluar->ttd_4 = "";
        $suratkeluar->nama_4 = "";
        $suratkeluar->nip_4 = "";
        $suratkeluar->save();
        return json_encode(1);
    }
    public function printsuratkeluar($id){
        $idsurat = Crypt::decryptString($id);
        $pengaturan = Pengaturan::findOrFail(1);
        $suratkeluar = SuratKeluar::findOrFail($idsurat);
        $perihal = Perihal::where('kode',$suratkeluar->perihal)->first();
        Date::setLocale('id');
        $tanggal = Carbon::createFromFormat('Y-m-d', $suratkeluar->tanggal_surat)->format('j F Y');
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
        return view('admin.suratkeluar.cetak',compact('suratkeluar','perihal','nomor','tanggal','pengaturan'));
    }
    public function datatablesuratkeluar(){
    $model = SuratKeluar::where('nomor_surat','!=','reset')->orderBy('created_at','desc');
    return DataTables::eloquent($model)
    ->addColumn('action', function($row){
                    $urlPrint = url('printsuratkeluar',Crypt::encryptString($row->id));
                    $urlEdit = url('editsuratkeluar',Crypt::encryptString($row->id));
                    $urlDelete = url('deletesuratkeluar',Crypt::encryptString($row->id));
                    $btn = '
                    <a href="'.$urlPrint.'" class="btn btn-success btn-sm edit" target="_blank">
                    <i class="fas fa-print"></i>
                    </a>
                    <a href="'.$urlEdit.'" class="btn btn-primary btn-sm edit">
                    <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="'.$urlDelete.'" class="btn btn-danger btn-sm delete">
                    <i class="fas fa-trash"></i>
                    </a>
                    ';
                  
                    return $btn;

        })
    ->addColumn('file', function($row){
                if($row->file_surat==""){
                    $url = url('admin/uploadsuratkeluar',Crypt::encryptString($row->id));
                    $btn = '
                                <a href="'.$url.'" class="btn btn-primary btn-sm edit">
                                <i class="fas fa-upload"></i> Upload
                                </a>  
                                ';
                    return $btn;    
                }
                $url = url('file/suratkeluar',$row->file_surat);
                $btn = '
                            <a target="_blank" href="'.$url.'" ">
                            Unduh
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
    ->rawColumns(['action','file','nomor'])
    ->addIndexColumn()
    ->toJson();
    }

}
