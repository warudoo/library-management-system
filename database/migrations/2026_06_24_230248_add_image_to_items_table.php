<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    /*
    Menambah kolom gambar pada item

    contoh:
    buku  = cover
    obat  = foto obat
    toko  = foto produk
    */


    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {


            // nullable agar data lama tetap aman
            $table->string('image')
                ->nullable()
                ->after('price');


        });
    }



    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {


            $table->dropColumn('image');


        });
    }

};