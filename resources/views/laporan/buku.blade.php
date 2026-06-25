<h2 align="center">
Laporan Data Buku
</h2>


<table border="1" width="100%" cellspacing="0">


<tr>

<th>No</th>
<th>Judul</th>
<th>Kategori</th>
<th>Pengarang</th>
<th>Penerbit</th>
<th>Tahun</th>


</tr>


@foreach($buku as $b)



<tr>

<td>{{ $loop->iteration }}</td>

<td>
{{ $b->judul_buku }}
</td>

<td>
{{ $b->kategori->nama_kategori ?? '-' }}
</td>

<td>
{{ $b->pengarang }}
</td>

<td>
{{ $b->penerbit }}
</td>


<td>
{{ $b->tahun }}
</td>


</tr>


@endforeach


</table>