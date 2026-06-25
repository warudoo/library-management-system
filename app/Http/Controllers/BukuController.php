<?php

namespace App\Http\Controllers;


use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;


class BukuController extends Controller
{


    public function index()
    {

        $buku = Buku::with('kategori')
            ->latest()
            ->get();


        return view(
            'bukus.index',
            compact('buku')
        );

    }




    public function create()
    {

        $kategori = KategoriBuku::all();


        return view(
            'bukus.create',
            compact('kategori')
        );

    }





    public function store(Request $request)
    {


        $request->validate([

            'judul_buku' => 'required',

            'pengarang' => 'required',

            'penerbit' => 'required',

            'tahun' => 'required',

            'isbn' => 'required',

            'tgl_input' => 'required',

            'jml_halaman' => 'required',

            'kategori_buku_id' => 'required'


        ]);



        Buku::create($request->all());



        return redirect()
            ->route('buku.index')
            ->with(
                'success',
                'Buku berhasil ditambahkan'
            );


    }






    public function edit(Buku $buku)
    {


        $kategori = KategoriBuku::all();



        return view(
            'bukus.edit',
            compact(
                'buku',
                'kategori'
            )
        );

    }







    public function update(
        Request $request,
        Buku $buku
    )
    {


        $request->validate([

            'judul_buku' => 'required',

            'pengarang' => 'required',

            'penerbit' => 'required',

            'tahun' => 'required|integer|min:1901|max:2155',

            'isbn' => 'required',

            'tgl_input' => 'required',

            'jml_halaman' => 'required',

            'kategori_buku_id' => 'required',
            
            'stok'=>'required|integer|min:0',
            


        ]);



        $buku->update(
            $request->all()
        );



        return redirect()
            ->route('buku.index')
            ->with(
                'success',
                'Buku berhasil diperbarui'
            );


    }






    public function destroy(Buku $buku)
    {


        $buku->delete();



        return back()
            ->with(
                'success',
                'Buku berhasil dihapus'
            );


    }


}
