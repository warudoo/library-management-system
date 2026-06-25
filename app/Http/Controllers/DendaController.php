<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;


class DendaController extends Controller
{


    public function index()
    {

        $denda = Denda::latest()->get();


        return view(
            'denda.index',
            compact('denda')
        );

    }




    public function create()
    {

        return view('denda.create');

    }






    public function store(Request $request)
    {


        $request->validate([

            'nominal' => 'required|integer|min:0'

        ]);



        Denda::create([

            'nominal' => $request->nominal

        ]);



        return redirect()
            ->route('denda.index')
            ->with(
                'success',
                'Denda berhasil ditambahkan'
            );


    }







    public function edit(Denda $denda)
    {

        return view(
            'denda.edit',
            compact('denda')
        );

    }






    public function update(
        Request $request,
        Denda $denda
    )
    {


        $request->validate([

            'nominal'=>'required|integer|min:0'

        ]);



        $denda->update([

            'nominal'=>$request->nominal

        ]);



        return redirect()
            ->route('denda.index')
            ->with(
                'success',
                'Denda berhasil diperbarui'
            );


    }







    public function destroy(Denda $denda)
    {


        $denda->delete();



        return back()
            ->with(
                'success',
                'Denda berhasil dihapus'
            );


    }


}
