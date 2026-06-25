<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPinjam extends Model
{

    protected $guarded = [];


    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }


    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

}

