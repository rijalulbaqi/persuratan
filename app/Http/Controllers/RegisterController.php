<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    public function index()
    {
        $prodi = Prodi::all();
        return view('auth.register', compact('prodi'));
    }
    public function register(Request $request)
    {
        $data = new User;
        $data->name = $request->nama;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->role = "mahasiswa";
        $data->status = "0";
        $data->save();

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->user_id = $data->id;
        $mahasiswa->prodi_id = $request->prodi_id;
        $mahasiswa->semester = $request->semester;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->email = $request->email;
        $mahasiswa->jenis_kelamin = "";
        $mahasiswa->tempat_lahir = "";
        $mahasiswa->tanggal_lahir = "";
        $mahasiswa->no_telp = "";
        $mahasiswa->alamat = "";
        $mahasiswa->foto = "default.jpg";
        $mahasiswa->save();
        return redirect('login')->with('success','Anda sudah daftar! Hubungi admin untuk aktivasi atau tunggu 1x24 Jam!');
    }
}