<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\DetailPinjam;

use Illuminate\Support\Facades\Hash;



class PerpustakaanSeeder extends Seeder
{


    public function run(): void
    {



        /*
        |--------------------------------------------------------------------------
        | USER PETUGAS
        |--------------------------------------------------------------------------
        */


        $admin = User::create([

            'name' => 'Admin Perpus',

            'email' => 'rudo@gmail.com',

            'password' => Hash::make('password'),

            'role' => 'admin'

        ]);








        /*
        |--------------------------------------------------------------------------
        | KATEGORI BUKU
        |--------------------------------------------------------------------------
        */


        $programming = KategoriBuku::create([

            'nama_kategori'=>'Programming'

        ]);



        $novel = KategoriBuku::create([

            'nama_kategori'=>'Novel'

        ]);









        /*
        |--------------------------------------------------------------------------
        | BUKU
        |--------------------------------------------------------------------------
        */



        $buku1 = Buku::create([

            'judul_buku'=>'Laravel Dasar',

            'pengarang'=>'Taylor Otwell',

            'penerbit'=>'Gramedia',

            'tahun'=>'2024',

            'isbn'=>'978001',

            'tgl_input'=>now(),

            'jml_halaman'=>350,

            'stok'=>5,

            'kategori_buku_id'=>$programming->id

        ]);





        $buku2 = Buku::create([

            'judul_buku'=>'Belajar PHP Modern',

            'pengarang'=>'Eko Kurniawan',

            'penerbit'=>'Informatika',

            'tahun'=>'2025',

            'isbn'=>'978002',

            'tgl_input'=>now(),

            'jml_halaman'=>280,

            'stok'=>3,

            'kategori_buku_id'=>$programming->id

        ]);









        /*
        |--------------------------------------------------------------------------
        | ANGGOTA
        |--------------------------------------------------------------------------
        */


        $anggota = Anggota::create([

            'nama'=>'Budi Santoso',

            'alamat'=>'Jakarta Selatan',

            'no_telepon'=>'08123456789',

            'tgl_lahir'=>'2000-01-01',

            'tgl_daftar'=>now()

        ]);








        /*
        |--------------------------------------------------------------------------
        | DENDA
        |--------------------------------------------------------------------------
        */


        $denda = Denda::create([

            'nominal'=>5000

        ]);









        /*
        |--------------------------------------------------------------------------
        | PEMINJAMAN
        |--------------------------------------------------------------------------
        */


        $pinjam = Peminjaman::create([

            'tgl_pinjam'=>now(),

            'lama_pinjam'=>7,

            'nominal_denda'=>0,


            'anggota_id'=>$anggota->id,


            'user_id'=>$admin->id,


            'denda_id'=>$denda->id

        ]);








        /*
        |--------------------------------------------------------------------------
        | DETAIL PINJAM
        |--------------------------------------------------------------------------
        */


        DetailPinjam::create([


            'peminjaman_id'=>$pinjam->id,


            'buku_id'=>$buku1->id,


            'tgl_kembali'=>null


        ]);




        // karena buku sedang dipinjam

        $buku1->decrement('stok');



    }


}
