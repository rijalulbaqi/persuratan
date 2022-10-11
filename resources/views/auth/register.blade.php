@extends('layouts.app')

@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  @error('email')
            <div class="alert alert-primary" role="alert">
              Email atau Password yang anda masukkan salah
            </div>
        @enderror
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{url('/')}}" class="h1"><b>SIMADU</b> UNIRA</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Daftar untuk masuk ke SIMADU</p>

      <form method="post" action="{{ url('daftar') }}">
        @csrf
        <div class="input-group mb-3">
          <input id="nama" placeholder="Nama Lengkap" type="text" class="form-control" name="nama" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="nim" placeholder="Nomer Induk Mahasiswa" type="number" class="form-control" name="nim" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select name="prodi_id" id="prodi_id" class="form-control">
                @foreach($prodi as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                @endforeach
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="semester" placeholder="Semester" type="number" class="form-control" name="semester" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="email" placeholder="Email" type="email" class="form-control" name="email" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input placeholder="Password" id="password" type="password" class="form-control password" name="password" required >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input placeholder="Konfirmasi Password" id="password-confirm" type="password" class="form-control password-confirm" name="password-confirm" required >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div id="validationServer03Feedback" class="invalid-feedback alert-confirm"></div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <p class="mb-0">
        <a href="{{ url('login') }}" class="text-center">Login</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@push('script')
<script type="text/javascript">
  $(document).ready(function (){

    $(".password-confirm").on('input',function(event){
      var val1 = $(this).val();
      var val2 = $(".password").val();
      if(val1 != val2){
        $('.password-confirm').addClass('is-invalid');
        $('.alert-confirm').html('<small style="font-size:9pt;">Password yang anda masukkan tidak sama</small>');
      }else{
        $('.password-confirm').removeClass('is-invalid');
        $('.alert-confirm').html('');
      }
    });
  })
</script>
@endpush
@endsection
