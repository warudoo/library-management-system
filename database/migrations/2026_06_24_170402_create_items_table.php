<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{


    /**
     * Tabel utama
     *
     * Bisa menjadi:
     * Buku
     * Obat
     * Produk
     * Barang
     */


    public function up(): void
    {


        Schema::create('items', function (Blueprint $table) {


            $table->id();



            /*
            Relasi ke kategori
            */

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();



            /*
            Nama item

            Buku  = judul buku
            Apotek = nama obat
            Toko = nama produk

            */

            $table->string('name');



            /*
            Deskripsi tambahan
            */

            $table->text('description')
                  ->nullable();



            /*
            Jumlah stok
            */

            $table->integer('stock');



            /*
            Harga

            kalau sistem perpustakaan
            bisa diisi 0

            */

            $table->integer('price')
                  ->default(0);



            $table->timestamps();


        });


    }



    public function down(): void
    {
        Schema::dropIfExists('items');
    }



};
