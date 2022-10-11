@extends('kepsek.app')
@section('content')
@include('kepsek.menu')
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
              <li class="breadcrumb-item active">Ubah Password</li>
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
                <h3 class="card-title">Ubah Password</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('kepsek/ubahpassword') }}" method="post">
                  @csrf
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password" class="form-control password" id="password" placeholder="Password Baru" required>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Konfirmasi Password Baru</label>
                    <input type="password" name="password-confirm" class="form-control password-confirm" id="password-confirm" placeholder="Konfirmasi Password Baru" required>
                <div id="validationServer03Feedback" class="invalid-feedback alert-confirm"></div>
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
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
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