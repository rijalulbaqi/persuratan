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
        <!-- /.row -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cetak Laporan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/filterlaporansuratkeluar') }}" method="post">
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
                    </div>
                    <div class="col">
                      <label>Jenis</label>
                      <select name="jenis_surat" class="form-control">
                        @foreach($jenis as $j)
                        <option value="{{ $j->kode_surat }}">{{ $j->jenis_surat }}</option>
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
                <h3 class="card-title">Data Surat Keluar</h3>
                <button class="btn btn-sm btn-round float-right btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus-circle"></i> Tambah</button>&nbsp;
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
                    <th>File</th>
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
      <h5 class="modal-title">Tambah Surat Keluar</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <form class="form-data" action="{{ url('tambahsuratkeluar') }}" id="formtambah" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
            <div class="col-sm-9">
              <input name="nomor_surat" type="text" class="form-control" value="@if($nomor==null) 1 @elseif($nomor->nomor_surat!='reset') {{ $nomor->nomor_surat+1 }} @elseif($nomor->nomor_surat=='reset') 1 @endif" required readonly>
              @if($user->id == "93")
              <a class="btn btn-sm btn-round btn btn-danger reset" href="{{ url('admin/resetnomor') }}"><i class="fas fa-sync-alt"></i> Reset Nomor</a>
              @elseif($user->id != "93")
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="jenis_surat" class="col-sm-3 col-form-label">Jenis Surat</label>
            <div class="col-sm-9">
              <select name="jenis_surat" class="form-control">
                @foreach($jenis as $j)
                <option value="{{ $j->kode_surat }}">{{ $j->jenis_surat }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
            <div class="col-sm-9">
              <select name="perihal" class="form-control">
                @foreach($perihal as $p)
                <option value="{{ $p->kode }}">{{ $p->perihal }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="lampiran" class="col-sm-3 col-form-label">Jumlah Lampiran</label>
            <div class="col-sm-9">
              <input name="lampiran" type="number" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="isi" class="col-sm-3 col-form-label">Isi Surat</label>
            <div class="col-sm-9">
              <textarea name="isi" class="editor form-control" id="editor" required>
                <p><strong><em>Assalamu&rsquo;alaikum Warahmattulah Wabarakatuh.</em></strong></p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Puji syukur kami panjatkan kehadirat Allah SWT atas segala nikmatnya, sholawat serta salam semoga senantiasa tercurah kepada Nabi Muhammad SAW. Aamiin.<br />
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sehubungan dengan telah dilaksanakan ujian sekolah pendidikan berbasis komputer dan smartphone dan akan dilangsungkan acara wisuda. kami mengharapkan kehadiran bapak/ibu pada:</p>

                <p>&nbsp; &nbsp; &nbsp;Hari, Tanggal&nbsp; : Sabtu, 21 Mei 2022<br />
                &nbsp; &nbsp; &nbsp;Waktu&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: 07.00 WIB<br />
                &nbsp; &nbsp; &nbsp;Tempat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: Gedung SMKS Riyadlul Qur&#39;an<br />
                &nbsp; &nbsp; &nbsp;Acara&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : Wisuda</p>

                <p>Mengingat pentingnya acara ini, maka kami mohon untuk berkenan hadir dalam acara tersebut.<br />
                Demikian surat undangan ini, atas perhatian dan kerjasamanya kami sampaikan terimakasih.</p>

                <p><strong><em>Wassalamu&#39;alaikum Warahmatullahi Wabarakatuh</em></strong></p>
              </textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
            <div class="col-sm-9">
              <input name="tanggal_surat" type="date" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="tujuan_surat" class="col-sm-3 col-form-label">Tujuan Surat</label>
            <div class="col-sm-9">
              <input name="tujuan_surat" type="text" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="tujuan_surat" class="col-sm-3 col-form-label">Jumlah Tanda Tangan</label>
            <div class="col-sm-9">
              <select name="jumlah_ttd" class="form-control" onchange="berapa(this);">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
              </select>
            </div>
          </div>
          <div id="if1" class="form-group row" style="display: block;">
            <label for="ttd_1" class="col-sm-6 col-form-label">TTD 1 (Jabatan, Nama, NIP)</label>
            <div class="col-sm-12">
              <input name="ttd_1" type="text" class="form-control" placeholder="Jabatan" value="Kepala Sekolah" required>
            </div>
            <div class="col-sm-12">
              <input name="nama_1" type="text" class="form-control" placeholder="Nama" value="{{ $pengaturan->kepala_lembaga }}" required>
            </div>
            <div class="col-sm-12">
              <input name="nip_1" type="text" class="form-control" placeholder="NIP" value="{{ $pengaturan->nip }}" required>
            </div>
          </div>
          <div id="if2" class="form-group row" style="display: none;">
            <label for="ttd_2" class="col-sm-3 col-form-label">TTD 2</label>
            <div class="col-sm-12">
              <input name="ttd_2" type="text" class="form-control" placeholder="Jabatan" value="-" required>
            </div>
            <div class="col-sm-12">
              <input name="nama_2" type="text" class="form-control" placeholder="Nama" value="-" required>
            </div>
            <div class="col-sm-12">
              <input name="nip_2" type="text" class="form-control" placeholder="NIP" value="-" required>
            </div>
          </div>
          <div id="if3" class="form-group row" style="display: none;">
            <label for="ttd_3" class="col-sm-3 col-form-label">TTD 3</label>
            <div class="col-sm-12">
              <input name="ttd_3" type="text" class="form-control" placeholder="Jabatan" value="-" required>
            </div>
            <div class="col-sm-12">
              <input name="nama_3" type="text" class="form-control" placeholder="Nama" value="-" required>
            </div>
            <div class="col-sm-12">
              <input name="nip_3" type="text" class="form-control" placeholder="NIP" value="-" required>
            </div>
          </div>
          <div id="if4" class="form-group row" style="display: none;">
            <label for="ttd_4" class="col-sm-3 col-form-label">TTD 4</label>
            <div class="col-sm-12">
              <input name="ttd_4" type="text" class="form-control" placeholder="Jabatan" value="-" required>
            </div>
            <div class="col-sm-12">
              <input name="nama_4" type="text" class="form-control" placeholder="Nama" value="-" required>
            </div>
            <div class="col-sm-12">
              <input name="nip_4" type="text" class="form-control" placeholder="NIP" value="-" required>
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
      function berapa(that) {
        if (that.value == "1") {
            document.getElementById("if1").style.display = "block";
            document.getElementById("if2").style.display = "none";
            document.getElementById("if3").style.display = "none";
            document.getElementById("if4").style.display = "none";
        }
        else if (that.value == "2") {
            document.getElementById("if2").style.display = "block";
            document.getElementById("if3").style.display = "none";
            document.getElementById("if4").style.display = "none";
        } else if (that.value == "3") {
            document.getElementById("if2").style.display = "block";
            document.getElementById("if3").style.display = "block";
            document.getElementById("if4").style.display = "none";
        } else if (that.value == "4") {
            document.getElementById("if2").style.display = "block";
            document.getElementById("if3").style.display = "block";
            document.getElementById("if4").style.display = "block";
        } else {
            document.getElementById("if2").style.display = "none";
        }
      }
      getdata();
  function getdata() {  
          $('#table-suratkeluar').DataTable({
            "autoWidth": false,
            "responsive": true,
            ajax: {
                url: '{{ url("admin/datasuratkeluar") }}',
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
                    {data: 'file', name: 'file'},
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
              $('#table-suratkeluar').DataTable().destroy();
              getdata();             
            }
          })
        });
        $(document).on('click', '.reset', function(event) {
          event.preventDefault();
          var url=$(this).attr('href');
          Swal.fire({
            title: 'Yakin ingin reset nomor?',
            text: "Nomor akan dimulai dari 1 lagi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!'
          }).then((result) => {

            if (result.isConfirmed) {
              
              $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
              })
              .done(function(data) {
                Swal.fire(
                  'Berhasil Reset Nomor!',
                  'Kamu telah memilih reset!',
                  'success'
                )
              }) 
              window.location.reload()             
            }
          })
        });
</script>
  @endpush
@endsection