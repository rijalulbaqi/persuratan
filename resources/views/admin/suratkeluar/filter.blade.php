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
            <h1 class="m-0">Surat Keluar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Surat Keluar</li>
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
                <h3 class="card-title">Data Surat Keluar Jenis {{ $jenis->jenis_surat }} Bulan {{ $bulan }} Tahun {{ $tahun }}</h3>
                <form action="{{ url('admin/cetaklaporansuratkeluar') }}" method="post">
                  @csrf
                      <input type="hidden" name="bulan" value="{{ $bulan }}">
                      <input type="hidden" name="tahun" value="{{ $tahun }}">
                      <input type="hidden" name="jenis_surat" value="{{ $jenis->kode_surat }}">
                  <button type="submit" class="btn btn-sm btn-round float-right btn btn-primary" name="submit"><i class="fas fa-print"></i> Cetak</button>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table-suratkeluar" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Perihal</th>
                    <th>Tujuan Surat</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @foreach($suratkeluar as $item)
                    @if((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==1)
                        @php $b = "I"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==2)
                        @php $b = "II"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==3)
                        @php $b = "III"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==4)
                        @php $b = "IV"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==5)
                        @php $b = "V"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==6)
                        @php $b = "VI"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==7)
                        @php $b = "VII"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==8)
                        @php $b = "VII"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==9)
                        @php $b = "IX"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==10)
                        @php $b = "X"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==11)
                        @php $b = "XI"; @endphp
                        @elseif((\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('m'))==12)
                        @php $b = "XII"; @endphp
                        @endif
                    <tr>
                      <td>{{ $no++; }}</td>
                      <td>{{ "0".$item->nomor_surat.".0".$item->jenis_surat."/".$item->perihal."/".$pengaturan->kode_lembaga."/".$b."/".\Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_surat)->format('Y') }}</td>
                      <td>
                        @foreach($jenissurat as $j)
                          @if($j->kode_surat == $item->jenis_surat)
                          {{ $j->jenis_surat }}
                          @else
                          @endif
                        @endforeach
                      </td>
                      <td>{{ $item->tanggal_surat }}</td>
                      <td>
                        @foreach($perihal as $p)
                          @if($p->kode == $item->perihal)
                          {{ $p->perihal }}
                          @else
                          @endif
                        @endforeach
                      </td>
                      <td>{{ $item->tujuan_surat }}</td>
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
          $('#table-suratkeluar').DataTable({
            "autoWidth": false,
            "responsive": true,    
        });
</script>
  @endpush
@endsection