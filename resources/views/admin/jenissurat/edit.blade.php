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
            <h1 class="m-0">Jenis Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin/jenis_surat') }}">Jenis Surat</a></li>
              <li class="breadcrumb-item active">Edit Jenis</li>
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
                <h3 class="card-title">Edit Perihal</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/ubahjenissurat') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input name="id" type="hidden" class="form-control" required value="{{ $jenissurat->id }}">
                  <div class="form-group">
                  <label for="kode_surat" class="col-sm-3 col-form-label">Kode Nomor</label>
                  <div>
                    <input name="kode_surat" type="number" class="form-control" required value="{{ $jenissurat->kode_surat }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="jenis_surat" class="col-sm-3 col-form-label">Jenis Surat</label>
                  <div>
                    <input name="jenis_surat" type="text" class="form-control" required value="{{ $jenissurat->jenis_surat }}">
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