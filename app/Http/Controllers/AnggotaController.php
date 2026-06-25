<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;


class AnggotaController extends Controller
{


    public function index()
    {
        $anggota = Anggota::latest()->get();

        return view(
            'anggota.index',
            compact('anggota')
        );
    }




    public function create()
    {
        return view('anggota.create');
    }





    public function store(Request $request)
    {

        $request->validate([

            'nama'=>'required',
            'alamat'=>'required',
            'no_telepon'=>'required',
            'tgl_lahir'=>'required',
            'tgl_daftar'=>'required'

        ]);



        Anggota::create(
            $request->all()
        );



        return redirect()
            ->route('anggota.index')
            ->with(
                'success',
                'Anggota berhasil ditambahkan'
            );

    }







    public function edit(Anggota $anggota)
    {

        return view(
            'anggota.edit',
            compact('anggota')
        );

    }







    public function update(
        Request $request,
        Anggota $anggota
    )
    {


        $request->validate([

            'nama'=>'required',
            'alamat'=>'required',
            'no_telepon'=>'required',
            'tgl_lahir'=>'required',
            'tgl_daftar'=>'required'

        ]);




        $anggota->update(
            $request->all()
        );



        return redirect()
            ->route('anggota.index')
            ->with(
                'success',
                'Anggota berhasil diperbarui'
            );

    }








    public function destroy(Anggota $anggota)
    {

        $anggota->delete();


        return back()
            ->with(
                'success',
                'Anggota berhasil dihapus'
            );

    }



}