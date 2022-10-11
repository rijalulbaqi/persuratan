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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin/suratmasuk') }}">Surat Masuk</a></li>
              <li class="breadcrumb-item active">Edit Surat</li>
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
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Surat Masuk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/pengguna/ubahsuratmasuk') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input name="id" type="hidden" class="form-control" required value="{{ $suratmasuk->id }}">
                  <div class="form-group">
                  <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
                  <div>
                    <input name="nomor_surat" type="text" class="form-control" required value="{{ $suratmasuk->nomor_surat }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                  <div>
                    <input name="tanggal_surat" type="date" class="form-control" required value="{{ $suratmasuk->tanggal_surat }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tanggal_terima" class="col-sm-3 col-form-label">Tanggal Terima</label>
                  <div>
                    <input name="tanggal_terima" type="date" class="form-control" required value="{{ $suratmasuk->tanggal_terima }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="asal_surat" class="col-sm-3 col-form-label">Asal Surat</label>
                  <div>
                    <input name="asal_surat" type="text" class="form-control" required value="{{ $suratmasuk->asal_surat }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                  <div>
                    <input name="perihal" type="text" class="form-control" required value="{{ $suratmasuk->perihal }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="file_surat" class="col-sm-3 col-form-label">File</label>
                  <div>
                    <input name="file_surat" type="file" class="form-control">
                  </div>
                  <a href="{{ url('file/suratmasuk/'.$suratmasuk->file_surat) }}">{{ $suratmasuk->file_surat }}</a>
                </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                </div>
                </form>
            </div>
            @push('script')
    <script>
  $(document).ready(function (){

    $(".password-confirm").on('input',function(event){
      var val1 = $(this).val();
      var val2 = $(".password").val();
      if(val1 != val2){
        $('.password-confirm').addClass('is-invalid');
        $('.alert-confirm').html('<small style="font-size:9pt;">Password yang anda masukkan tidak sama</small>');
        $('.btn-simpan').attr("disabled",true);
      }else{
        $('.password-confirm').removeClass('is-invalid');
        $('.alert-confirm').html('');
        $('.btn-simpan').attr("disabled",false);
      }
    });
  })
</script>
  @endpush
@endsection