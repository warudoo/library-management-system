<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{


    public function index()
    {
        $kategori = KategoriBuku::latest()->get();

        return view(
            'kategori-buku.index',
            compact('kategori')
        );
    }



    public function create()
    {
        return view('kategori-buku.create');
    }



    public function store(Request $request)
    {

        $request->validate([
            'nama_kategori' => 'required'
        ]);


        KategoriBuku::create([
            'nama_kategori' => $request->nama_kategori
        ]);


        return redirect()
            ->route('kategori-buku.index')
            ->with(
                'success',
                'Kategori berhasil ditambah'
            );
    }



    public function edit(KategoriBuku $kategori_buku)
    {
        return view(
            'kategori-buku.edit',
            compact('kategori_buku')
        );
    }




    public function update(
        Request $request,
        KategoriBuku $kategori_buku
    )
    {


        $request->validate([
            'nama_kategori'=>'required'
        ]);


        $kategori_buku->update([
            'nama_kategori'=>$request->nama_kategori
        ]);


        return redirect()
            ->route('kategori-buku.index')
            ->with(
                'success',
                'Kategori berhasil update'
            );
    }





    public function destroy(
        KategoriBuku $kategori_buku
    )
    {

        $kategori_buku->delete();


        return back()
            ->with(
                'success',
                'Kategori dihapus'
            );

    }


}