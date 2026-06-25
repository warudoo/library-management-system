<h2 align="center">
Laporan Peminjaman Buku
</h2>


<table border="1" width="100%" cellspacing="0">


<tr>

<th>No</th>

<th>Anggota</th>

<th>Buku</th>

<th>Petugas</th>

<th>Tanggal Pinjam</th>

<th>Denda</th>


</tr>



@foreach($peminjaman as $p)



<tr>


<td>
{{ $loop->iteration }}
</td>



<td>
{{ $p->anggota->nama }}
</td>



<td>

@foreach($p->detail as $d)

{{ $d->buku->judul_buku }}

@endforeach


</td>



<td>

{{ $p->user->name }}

</td>




<td>

{{ $p->tgl_pinjam }}

</td>




<td>

Rp {{ number_format($p->nominal_denda) }}

</td>




</tr>



@endforeach



</table>