<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailPinjam;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PeminjamanController extends Controller
{


    public function index()
    {

        $peminjaman = Peminjaman::with([
            'anggota',
            'user',
            'detail.buku'
        ])
        ->latest()
        ->get();


        return view(
            'peminjaman.index',
            compact('peminjaman')
        );

    }





    public function create()
    {

        $anggota = Anggota::all();

        $buku = Buku::all();



        return view(
            'peminjaman.create',
            compact(
                'anggota',
                'buku'
            )
        );

    }







    public function store(Request $request)
    {


        $request->validate([

            'anggota_id'=>'required',

            'buku_id'=>'required',

            'tgl_pinjam'=>'required',

            'lama_pinjam'=>'required'

        ]);




        $pinjam = Peminjaman::create([


            'anggota_id'=>$request->anggota_id,


            'user_id'=>auth()->id(),


            'tgl_pinjam'=>$request->tgl_pinjam,


            'lama_pinjam'=>$request->lama_pinjam,


            'nominal_denda'=>0


        ]);




        DetailPinjam::create([

            'peminjaman_id'=>$pinjam->id,


            'buku_id'=>$request->buku_id,


            'tgl_kembali'=>null


        ]);






        return redirect()
            ->route('peminjaman.index')
            ->with(
                'success',
                'Peminjaman berhasil dibuat'
            );


    }






    public function destroy(Peminjaman $peminjaman)
    {

        $peminjaman->delete();


        return back()
            ->with(
                'success',
                'Data peminjaman dihapus'
            );

    }

    public function kembali(Peminjaman $peminjaman)
{


    $detail = $peminjaman
        ->detail()
        ->first();



    if($detail->tgl_kembali != null)
    {

        return back()
            ->with(
                'error',
                'Buku sudah dikembalikan'
            );

    }





    $tanggalKembali = now();



    $detail->update([

        'tgl_kembali'=>$tanggalKembali

    ]);





    $jatuhTempo = Carbon::parse(
        $peminjaman->tgl_pinjam
    )
    ->addDays(
        $peminjaman->lama_pinjam
    );





    $terlambat = 
        $tanggalKembali
        ->diffInDays(
            $jatuhTempo,
            false
        );





    $denda = 0;



    if($terlambat < 0)
    {

        $hariTelat = abs($terlambat);


        // Rp 5000 per hari

        $denda = $hariTelat * 5000;

    }






    $peminjaman->update([

        'nominal_denda'=>$denda

    ]);







    return back()
        ->with(
            'success',
            'Buku berhasil dikembalikan'
        );


}

}