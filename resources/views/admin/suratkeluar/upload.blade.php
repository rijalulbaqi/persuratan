@extends('admin.app')
@section('content')
@include('admin.menu')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Surat Keluar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin/suratkeluar') }}">Surat Keluar</a></li>
              <li class="breadcrumb-item active">Upload Surat</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
        @elseif ($message = Session::get('failed'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload Surat Keluar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/uploadsuratkeluar') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input name="id" type="hidden" class="form-control" required value="{{ $suratkeluar->id }}">
                <div class="form-group">
                  <label for="file_surat" class="col-sm-3 col-form-label">File</label>
                  <div>
                    <input name="file_surat" type="file" class="form-control">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                </div>
                </form>
            </div>
@endsection