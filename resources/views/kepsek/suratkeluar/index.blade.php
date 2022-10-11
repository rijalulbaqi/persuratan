@extends('kepsek.app')
@section('content')
@include('kepsek.menu',array('active'=>$active))
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
              <li class="breadcrumb-item active">Dashboard</li>
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
                <h3 class="card-title">Data Surat Keluar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($message = Session::get('failed'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('success'))
                <div class="alert alert-primary alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table id="table-suratkeluar" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tujuan Surat</th>
                    <th>Perihal</th>
                    <th>File</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>


</div>
            @push('script')
    <script>
      getdata();
  function getdata() {  
          $('#table-suratkeluar').DataTable({
            "autoWidth": false,
            "responsive": true,
            ajax: {
                url: '{{ url("kepsek/datasuratkeluar") }}',
            },
             rowReorder: {
                selector: 'td:nth-child(2)'
            },

            responsive: true,
            columns: [
                    {
                            "data": 'DT_RowIndex',
                            orderable: false, 
                            searchable: false
                        },
                    {data: 'nomor', name: 'nomor'},
                    {data: 'tanggal_surat', name: 'tanggal_surat'},
                    {data: 'tujuan_surat', name: 'tujuan_surat'},
                    {data: 'perihal', name: 'perihal'},
                    {data: 'file', name: 'file'},
                    
                ],
                
        });

        }
</script>
  @endpush
@endsection