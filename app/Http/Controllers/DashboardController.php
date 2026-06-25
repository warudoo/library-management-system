<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Peminjaman;
use Carbon\Carbon;


class DashboardController extends Controller
{


    public function index()
    {


        $totalAnggota =
            Anggota::count();


        $totalBuku =
            Buku::count();


        $totalKategori =
            KategoriBuku::count();





        $totalPinjam =
            Peminjaman::count();





        $totalAktif =
            Peminjaman::whereHas(
                'detail',
                function($q){

                    $q->whereNull(
                        'tgl_kembali'
                    );

                }
            )->count();






        $totalTerlambat =
            Peminjaman::whereHas(
                'detail',
                function($q){

                    $q->whereNull(
                        'tgl_kembali'
                    );

                }
            )
            ->get()
            ->filter(function($p){


                return Carbon::parse(
                    $p->tgl_pinjam
                )
                ->addDays(
                    $p->lama_pinjam
                )
                ->isPast();


            })
            ->count();







        $totalDenda =
            Peminjaman::sum(
                'nominal_denda'
            );








        $recentTransactions =
            Peminjaman::with([
                'anggota',
                'detail.buku'
            ])
            ->latest()
            ->take(5)
            ->get();








        return view(
            'dashboard',
            compact(

                'totalAnggota',
                'totalBuku',
                'totalKategori',
                'totalPinjam',
                'totalAktif',
                'totalTerlambat',
                'totalDenda',
                'recentTransactions'

            )
        );



    }


}