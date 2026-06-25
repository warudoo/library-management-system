<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Buku extends Model
{

    protected $guarded = [];


    public function kategori()
    {

        return $this->belongsTo(
            KategoriBuku::class,
            'kategori_buku_id'
        );

    }

}