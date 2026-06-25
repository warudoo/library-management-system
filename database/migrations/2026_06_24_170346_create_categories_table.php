<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    /**
     * Membuat tabel kategori
     *
     * contoh:
     * - kategori buku
     * - kategori obat
     * - kategori barang
     */

    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {


            // primary key
            $table->id();


            // nama kategori
            $table->string('name');


            // waktu create dan update
            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
