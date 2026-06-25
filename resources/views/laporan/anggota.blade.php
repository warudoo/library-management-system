
<h2 align="center">
Laporan Data Anggota
</h2>


<table border="1" width="100%" cellspacing="0">

<tr>

<th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>Telepon</th>
<th>Tanggal Daftar</th>

</tr>



@foreach($anggota as $a)


<tr>

<td>{{ $loop->iteration }}</td>

<td>
{{ $a->nama }}
</td>

<td>
{{ $a->alamat }}
</td>

<td>
{{ $a->no_telepon }}
</td>


<td>
{{ $a->tgl_daftar }}
</td>


</tr>


@endforeach


</table>