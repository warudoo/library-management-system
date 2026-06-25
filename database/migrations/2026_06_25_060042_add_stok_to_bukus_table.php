<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up()
    {

        Schema::table('bukus', function (Blueprint $table) {


            $table->integer('stok')
                  ->default(0)
                  ->after('jml_halaman');


        });

    }



    public function down()
    {

        Schema::table('bukus', function (Blueprint $table) {

            $table->dropColumn('stok');

        });

    }

};