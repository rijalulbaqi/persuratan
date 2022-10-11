<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
           $row1 = Dosen::find($row['niy']);
           if (empty($row1)) {
              $data = new User;
                $data->name = $row['nama'];
                $data->email = $row['email'];
                $data->password = Hash::make($row['password']);
                $data->role = "dosen";
                $data->status = "1";
                $data->save();

                $dosen = new Dosen;
                $dosen->niy = $row['niy'];
                $dosen->nidn = $row['nidn'];
                $dosen->user_id = $data->id;
                $dosen->prodi_id = $row['kodeprodi'];
                $dosen->nama = $row['nama'];
                $dosen->email = $row['email'];
                $dosen->no_telp = $row['nomor'];
                $dosen->foto = "default.jpg";
                $dosen->save();
           } 
    }
}
