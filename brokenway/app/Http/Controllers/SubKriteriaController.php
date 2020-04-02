<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Subkriteria;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $kriteria = Kriteria::where('id_kriteria', '=', $id)->first();
        $subkriteria = Subkriteria::where('id_kriteria', '=', $id)->get();

        return view('sub_kriteria.index', compact('kriteria', 'subkriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = Kriteria::where('id_kriteria', '=', $id)->first();

        return view('sub_kriteria.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $insert = Subkriteria::insert([
            'id_kriteria'   => $id,
            'subkriteria'   => $request->nama_sub_kriteria,
            'nilai'         => $request->nilai
        ]);

        if ($insert) {
            return redirect('kriteria/'.$id.'/subkriteria')->withStatus(__('SubKriteria Berhasil Disimpan.'));
        } else {
            return redirect('kriteria/'.$id.'/subkriteria')->withStatus(__('SubKriteria Gagal Disimpan.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Subkriteria::where('id_subkriteria', '=', $id)->delete();

        if ($delete) {
            return back()->withStatus(__('Delete SubKriteria Berhasil.'));
        } else {
            return back()->withStatus(__('Delete SubKriteria Gagal.'));
        }
    }
}
