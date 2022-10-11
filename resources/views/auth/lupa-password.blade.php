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
      
      <div class="alert alert-primary" role="alert">Silahkan menghubungi TU Fakultas untuk merubah password anda</div>
      
      <p class="mb-1">
        <a href="{{ url('login') }}">Login</a>
      </p>
      <p class="mb-0">
        <a href="{{ url('daftar') }}" class="text-center">Daftar SIMADU</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@endsection
