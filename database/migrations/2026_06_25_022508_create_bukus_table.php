<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukus', function(Blueprint $table){

            $table->id();

            $table->string('judul_buku');

            $table->string('pengarang');

            $table->string('penerbit');

            $table->year('tahun');

            $table->string('isbn');

            $table->date('tgl_input');

            $table->integer('jml_halaman');


            $table->foreignId('kategori_buku_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
