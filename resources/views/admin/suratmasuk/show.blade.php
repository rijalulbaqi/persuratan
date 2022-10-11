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
            <h1 class="m-0">Surat Masuk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Surat Masuk</li>
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

                <h3 class="card-title">Surat No {{ $suratmasuk->nomor_surat }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
                  <div>
                    <input name="nomor_surat" type="text" class="form-control" required value="{{ $suratmasuk->nomor_surat }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                  <div>
                    <input name="tanggal_surat" type="text" class="form-control" required value="{{ $suratmasuk->tanggal_surat }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tanggal_terima" class="col-sm-3 col-form-label">Tanggal Terima</label>
                  <div>
                    <input name="tanggal_terima" type="text" class="form-control" required value="{{ $suratmasuk->tanggal_terima }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="asal_surat" class="col-sm-3 col-form-label">Asal Surat</label>
                  <div>
                    <input name="asal_surat" type="text" class="form-control" required value="{{ $suratmasuk->asal_surat }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                  <div>
                    <input name="perihal" type="text" class="form-control" required value="{{ $suratmasuk->perihal }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="file_surat" class="col-sm-3 col-form-label">File</label>
                  <div>
                    <a class="btn btn-success form-control" href="{{ url('file/suratmasuk/'.$suratmasuk->file_surat) }}" download> <i class="fas fa-download"> </i> {{ $suratmasuk->file_surat }}</a>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
@endsection