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
            <h1 class="m-0">Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
                <h3 class="card-title">Data Pengguna</h3>
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
                <table id="table-pengguna" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
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
      <h5 class="modal-title">Tambah Data Pengguna</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <form class="form-data" id="formtambah" method="post">
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input name="nama" type="text" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input name="email" type="email" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input name="password" type="password" class="form-control password" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-3 col-form-label">Ulangi Password</label>
              <div class="col-sm-9">
                <input name="password-confirm" type="password" class="form-control password-confirm" required>
                <div id="validationServer03Feedback" class="invalid-feedback alert-confirm">

                </div>
              </div>
            </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
      <input type="submit" disabled name="simpan" class="btn btn-primary submit btn-simpan" value="Simpan">
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
          $('#table-pengguna').DataTable({
            "autoWidth": false,
            "responsive": true,
            ajax: {
                url: '{{ url("admin/datapengguna") }}',
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
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    
                ],
                
        });

        }
        $('input[name="simpan"]').click(function(event) {
          event.preventDefault();
          var data=$('#formtambah').serialize();
          $.ajax({
            url: '{{ url("tambahpengguna") }}',
            type: 'POST',
            dataType: 'json',
            data: data,
          })
          .done(function(data) {
            if(data==1){
              $('#table-pengguna').DataTable().destroy();
              getdata();
              $('#tambahModal').modal('hide');
              Swal.fire(
                'Data Berhasil Ditambah!',
                'Kamu telah menambah data!',
                'success'
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
              $('#table-pengguna').DataTable().destroy();
              getdata();             
            }
          })
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