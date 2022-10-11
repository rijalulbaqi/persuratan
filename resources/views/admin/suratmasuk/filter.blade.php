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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Surat Masuk Bulan {{ $bulan }} Tahun {{ $tahun }}</h3>
                <form action="{{ url('admin/cetaklaporansuratmasuk') }}" method="post">
                  @csrf
                      <input type="hidden" name="bulan" value="{{ $bulan }}">
                      <input type="hidden" name="tahun" value="{{ $tahun }}">
                      <button type="submit" class="btn btn-sm btn-round float-right btn btn-primary" name="submit"><i class="fas fa-print"></i> Cetak</button>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table-suratmasuk" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Terima</th>
                    <th>Asal Surat</th>
                    <th>Perihal</th>
                    <th>Penerima</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @foreach($suratmasuk as $item)
                    <tr>
                      <td>{{ $no; }}</td>
                      <td>{{ $item->nomor_surat }}</td>
                      <td>{{ $item->tanggal_surat }}</td>
                      <td>{{ $item->tanggal_terima }}</td>
                      <td>{{ $item->asal_surat }}</td>
                      <td>{{ $item->perihal }}</td>
                      <td>{{ $item->penerima }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
</div>
            @push('script')
    <script>
          $('#table-suratmasuk').DataTable({
            "autoWidth": false,
            "responsive": true,    
        });
</script>
  @endpush
@endsection