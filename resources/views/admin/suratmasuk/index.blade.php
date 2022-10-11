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
                <h3 class="card-title">Cetak Laporan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/filterlaporansuratmasuk') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col">
                      <label>Bulan</label>
                      <select name="bulan" class="form-control">
                        @foreach($bulan as $b)
                        <option value="{{ $b->bulan }}">{{ $b->bulan }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col">
                      <label>Tahun</label>
                      <select name="tahun" class="form-control">
                        @foreach($tahun as $t)
                        <option value="{{ $t->tahun }}">{{ $t->tahun }}</option>
                        @endforeach
                      </select>
                      <input type="submit" class="btn btn-primary float-right" name="submit" value="Lihat">
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Surat Masuk</h3>
                <button class="btn btn-sm btn-round float-right btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus-circle"></i> Tambah</button>
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
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Tambah Surat Masuk</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <form class="form-data" action="{{ url('tambahsuratmasuk') }}" id="formtambah" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
            <div class="col-sm-9">
              <input name="nomor_surat" type="text" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
            <div class="col-sm-9">
              <input name="tanggal_surat" type="date" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal_terima" class="col-sm-3 col-form-label">Tanggal Terima</label>
            <div class="col-sm-9">
              <input name="tanggal_terima" type="date" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="asal_surat" class="col-sm-3 col-form-label">Asal Surat</label>
            <div class="col-sm-9">
              <input name="asal_surat" type="text" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
            <div class="col-sm-9">
              <input name="perihal" type="text" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="file_surat" class="col-sm-3 col-form-label">File</label>
            <div class="col-sm-9">
              <input name="file_surat" type="file" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="penerima" class="col-sm-3 col-form-label">Penerima</label>
            <div class="col-sm-9">
              <input name="penerima" type="text" class="form-control" readonly value="{{ $user->name }}">
            </div>
          </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
      <input type="submit" name="simpan" class="btn btn-primary submit btn-simpan" value="Simpan">
    </div>
    </form>
  </div>
</div>
</div>
</div>
            @push('script')
    <script>
      getdata();
  function getdata() {  
          $('#table-suratmasuk').DataTable({
            "autoWidth": false,
            "responsive": true,
            ajax: {
                url: '{{ url("admin/datasuratmasuk") }}',
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
                    {data: 'nomor_surat', name: 'nomor_surat'},
                    {data: 'tanggal_surat', name: 'tanggal_surat'},
                    {data: 'tanggal_terima', name: 'tanggal_terima'},
                    {data: 'asal_surat', name: 'asal_surat'},
                    {data: 'perihal', name: 'perihal'},
                    {data: 'penerima', name: 'penerima'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    
                ],
                
        });

        }
        $(document).on('click', '.delete', function(event) {
          event.preventDefault();
          var url=$(this).attr('href');
          Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Menghapus data akan menghilangkan data surat ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
          }).then((result) => {

            if (result.isConfirmed) {
              
              $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
              })
              .done(function(data) {
                Swal.fire(
                  'Surat Berhasil Dihapus!',
                  'Kamu telah memilih hapus!',
                  'success'
                )
              }) 
              $('#table-suratmasuk').DataTable().destroy();
              getdata();             
            }
          })
        });
</script>
  @endpush
@endsection