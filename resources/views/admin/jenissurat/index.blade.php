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
            <h1 class="m-0">Jenis Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jenis Surat</li>
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
                <h3 class="card-title">Jenis Surat</h3>
                <button class="btn btn-sm btn-round float-right btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus-circle"></i> Tambah</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($message = Session::get('failed'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table id="table-jenis" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Jenis</th>
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
      <h5 class="modal-title">Tambah Jenis Surat</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <form class="form-data" id="formtambah" method="post">
          <div class="form-group row">
            <label for="kode_surat" class="col-sm-3 col-form-label">Kode Angka</label>
            <div class="col-sm-9">
              <input name="kode_surat" type="number" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="jenis_surat" class="col-sm-3 col-form-label">Jenis Surat</label>
            <div class="col-sm-9">
              <input name="jenis_surat" type="text" class="form-control" required>
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
          $('#table-jenis').DataTable({
            "autoWidth": false,
            "responsive": true,
            ajax: {
                url: '{{ url("admin/datajenissurat") }}',
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
                    {data: 'kode_surat', name: 'kode_surat'},
                    {data: 'jenis_surat', name: 'jenis_surat'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    
                ],
                
        });

        }
        $('input[name="simpan"]').click(function(event) {
          event.preventDefault();
          var data=$('#formtambah').serialize();
          $.ajax({
            url: '{{ url("admin/tambahjenissurat") }}',
            type: 'POST',
            dataType: 'json',
            data: data,
          })
          .done(function(data) {
            if(data==1){
              $('#table-jenis').DataTable().destroy();
              getdata();
              $('#tambahModal').modal('hide');
              Swal.fire(
                'Data Berhasil Ditambah!',
                'Kamu telah menambah data!',
                'success'
              )
            }
            if(data==2){
              Swal.fire(
                'Kode sudah digunakan!',
              )
            }
            if(data==3){
              Swal.fire(
                'Pastikan isi semua!',
              )
            }
          });
        });

        $(document).on('click', '.delete', function(event) {
          event.preventDefault();
          var url=$(this).attr('href');
          Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Menghapus data akan menghilangkan data ini",
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
                  'Data Berhasil Dihapus!',
                  'Kamu telah memilih hapus!',
                  'success'
                )
              }) 
              $('#table-jenis').DataTable().destroy();
              getdata();             
            }
          })
        });
</script>
  @endpush
@endsection