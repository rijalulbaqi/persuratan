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
            <h1 class="m-0">Data Dosen</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/dosen') }}">Dosen</a></li>
              <li class="breadcrumb-item active">Data Dosen</li>
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
                <h3 class="card-title">Data {{ $dosen->nama }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <img class="img-fluid" src="{{ url('img/foto/'.$dosen->foto) }}">
                  <div class="form-group">
                  <label>NIY</label>
                  <input class="form-control" type="text" name="niy" value="{{ $dosen->niy }}" readonly>
                </div>
                <div class="form-group">
                  <label>NIDN</label>
                  <input class="form-control" type="text" name="nidn" value="{{ $dosen->nidn }}" readonly>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input class="form-control" type="text" name="nama" value="{{ $dosen->nama }}" readonly>
                </div>
                <div class="form-group">
                  <label>Program Studi</label>
                  <input class="form-control" type="text" name="prodi" value="{{ $dosen->prodi->nama_prodi }}" readonly>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" type="text" name="email" value="{{ $dosen->email }}" readonly>
                </div>
                <div class="form-group">
                  <label>Nomor Telepon</label>
                  <input class="form-control" type="text" name="no_telp" value="{{ $dosen->no_telp }}" readonly>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
@endsection