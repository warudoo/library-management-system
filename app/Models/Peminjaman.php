<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Peminjaman extends Model
{

    protected $guarded = [];


    protected $table = 'peminjamen';


    public function anggota()
    {

        return $this->belongsTo(
            Anggota::class,
            'anggota_id'
        );

    }




    public function user()
    {

        return $this->belongsTo(
            User::class,
            'user_id'
        );

    }




    public function detail()
    {

        return $this->hasMany(
            DetailPinjam::class,
            'peminjaman_id'
        );

    }


}