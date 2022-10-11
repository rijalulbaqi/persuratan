<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $nomor }}</title>
	
</head>
<body>
<style type="text/css">
 body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 300mm;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        height: 257mm;
    }
    
    @page {
        size: 210mm,330mm;
    }
    

	</style>
<div class="page">
	<div class="subpage">
<center>
<img style="width: 200mm;" src="{{ url('img/'.$pengaturan->kop_surat) }}">
<table width="735">
	<tr>
		<td width="80">Nomor</td>
		<td width="10">:</td>
		<td>{{ $nomor }}</td>
	</tr>
	<tr>
		<td>Lampiran</td>
		<td>:</td>
		<td>
			@if($suratkeluar->lampiran==0)
			-
			@else
			{{ $suratkeluar->lampiran }}
			@endif
		</td>
	</tr>
	<tr>
		<td>Perihal</td>
		<td>:</td>
		<td>{{ $perihal->perihal }}</td>
	</tr>
</table>
<br>
<table width="735">
	<tr>
		<td rowspan="5" width="80" valign="top"></td>
		<td valign="top" style="line-height: 1.5;">Kepada Yth.<br>
		<b>{{ $suratkeluar->tujuan_surat }}</b> <br>
		Di Tempat
		</td>
	</tr>
</table>
<table width="735">
	<tr>
		<td width="80"></td>
		<td align="justify" style="line-height: 1.5;">
			{!! $suratkeluar->isi !!}
		</td>
	</tr>
</table>
<table width="735">
	<tr>
		<td width="80"></td>
		<td width="260"></td>
		<td width="50"></td>
		<td width="260">
			Malang, {{ $tanggal }}
		</td>
	</tr>
	@if($suratkeluar->jumlah_ttd==1)
	<tr>
		<td width="80"></td>
		<td width="260"></td>
		<td width="50"></td>
		<td width="260">
			{{ $suratkeluar->ttd_1 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_1 }}</u><br>
			NIP. {{ $suratkeluar->nip_1 }}
		</td>
	</tr>
	@elseif($suratkeluar->jumlah_ttd==2)
	<tr>
		<td width="80"></td>
		<td width="260">
			{{ $suratkeluar->ttd_1 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_1 }}</u><br>
			NIP. {{ $suratkeluar->nip_1 }}
		</td>
		<td width="50"></td>
		<td width="260">
			{{ $suratkeluar->ttd_2 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_2 }}</u><br>
			NIP. {{ $suratkeluar->nip_2 }}
		</td>
	</tr>
	@elseif($suratkeluar->jumlah_ttd==3)
	<tr>
		<td width="80"></td>
		<td width="260">
			{{ $suratkeluar->ttd_1 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_1 }}</u><br>
			NIP. {{ $suratkeluar->nip_1 }}
		</td>
		<td width="50"></td>
		<td width="260">
			{{ $suratkeluar->ttd_2 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_2 }}</u><br>
			NIP. {{ $suratkeluar->nip_2 }}
		</td>
	</tr>
	<tr>
		<td colspan="4" align="center">Mengetahui</td>
	</tr>
	<tr>
		<td width="80"></td>
		<td width="180">
		</td>
		<td width="210">
			{{ $suratkeluar->ttd_3 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_3 }}</u><br>
			NIP. {{ $suratkeluar->nip_3 }}
		</td>
		<td width="180">
		</td>
	</tr>
	@elseif($suratkeluar->jumlah_ttd==4)
	<tr>
		<td width="80"></td>
		<td width="260">
			{{ $suratkeluar->ttd_1 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_1 }}</u><br>
			NIP. {{ $suratkeluar->nip_1 }}
		</td>
		<td width="50"></td>
		<td width="260">
			{{ $suratkeluar->ttd_2 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_2 }}</u><br>
			NIP. {{ $suratkeluar->nip_2 }}
		</td>
	</tr>
	<tr>
		<td colspan="4" align="center">Mengetahui</td>
	</tr>
	<tr>
		<td width="80"></td>
		<td width="260">
			{{ $suratkeluar->ttd_3 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_3 }}</u><br>
			NIP. {{ $suratkeluar->nip_3 }}
		</td>
		<td width="50"></td>
		<td width="260">
			{{ $suratkeluar->ttd_4 }}
			<br>
			<br>
			<br>
			<br>
			<u>{{ $suratkeluar->nama_4 }}</u><br>
			NIP. {{ $suratkeluar->nip_4 }}
		</td>
	</tr>
	@endif
</table>
</center>
	</div>
</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>