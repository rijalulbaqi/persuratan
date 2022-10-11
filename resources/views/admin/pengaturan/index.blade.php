@extends('admin.app')
@section('content')
@include('admin.menu',array('active'=>$active))
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengaturan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengaturan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan</h3>
                @if($user->id == "93")
                <button class="btn btn-sm btn-round float-right btn btn-primary" data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"></i> Edit</button>
                @elseif($user->id != "93")
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Lembaga</label>
                  <div class="col-sm-12">
                      {{ $p->nama_lembaga }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Kode Lembaga (digunakan pada nomor surat)</label>
                  <div class="col-sm-12">
                      {{ $p->kode_lembaga }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Kepala Lembaga</label>
                  <div class="col-sm-12">
                      {{ $p->kepala_lembaga }}
                  </div>
                </div>
                <div class="form-group">
                  <label>NIP</label>
                  <div class="col-sm-12">
                      {{ $p->nip }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Kop Surat</label>
                  <div class="col-sm-12">
                      <img class="w-100" src="{{ url('img/'.$p->kop_surat) }}">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Profil</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <form class="form-data" action="{{ url('admin/updatepengaturan') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <label for="nama_lembaga" class="col-sm-3 col-form-label">Nama Lembaga</label>
            <div class="col-sm-9">
              <input name="nama_lembaga" type="text" class="form-control" required value="{{ $p->nama_lembaga }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="kode_lembaga" class="col-sm-3 col-form-label">Kode Lembaga</label>
            <div class="col-sm-9">
              <input name="kode_lembaga" type="text" class="form-control" required value="{{ $p->kode_lembaga }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="kepala_lembaga" class="col-sm-3 col-form-label">Kepala Lembaga</label>
            <div class="col-sm-9">
              <input name="kepala_lembaga" type="text" class="form-control" required value="{{ $p->kepala_lembaga }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="nip" class="col-sm-3 col-form-label">NIP Kepala</label>
            <div class="col-sm-9">
              <input name="nip" type="text" class="form-control" required value="{{ $p->nip }}">
            </div>
          </div>          
          <div class="form-group row">
              <label for="kop_surat" class="col-sm-3 col-form-label">Kop Surat</label>
              <div class="col-sm-9">
                <input name="kop_surat" type="file" class="form-control">
              </div>
            </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
      <input type="submit" name="simpan" class="btn btn-primary submit btn-simpan" value="Simpan">
    </div>
    </form>
  </div>
</div>
</div>
@endsection