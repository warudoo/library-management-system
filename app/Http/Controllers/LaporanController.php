<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;

use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function anggota()
    {

        $anggota = Anggota::all();


        $pdf = Pdf::loadView(
            'laporan.anggota',
            compact('anggota')
        );


        return $pdf->stream(
            'laporan-anggota.pdf'
        );


    }
    public function buku()
    {


        $buku = Buku::with('kategori')
            ->get();



        $pdf = Pdf::loadView(
            'laporan.buku',
            compact('buku')
        );



        return $pdf->stream(
            'laporan-buku.pdf'
        );


    }
    public function peminjaman()
    {


        $peminjaman =
            Peminjaman::with([
                'anggota',
                'user',
                'detail.buku'
            ])
            ->get();

        $pdf = Pdf::loadView(
            'laporan.peminjaman',
            compact('peminjaman')
        );

        return $pdf->stream(
            'laporan-peminjaman.pdf'
        );

    }

}