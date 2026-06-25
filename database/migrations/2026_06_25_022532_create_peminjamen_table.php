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
        Schema::create('peminjamen', function(Blueprint $table){

            $table->id();

            $table->date('tgl_pinjam');

            $table->integer('lama_pinjam');

            $table->integer('nominal_denda')
                ->default(0);



            $table->foreignId('anggota_id')
                ->constrained()
                ->cascadeOnDelete();



            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();



            $table->foreignId('denda_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();



            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
