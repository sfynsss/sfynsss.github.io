<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Subkriteria;
use App\Mst_Alternatif;
use App\Det_Alternatif;
use App\User;

class AlternatifController extends Controller
{
    public function index()
    {
    	$kriteria = Kriteria::all();
    	$data = Mst_Alternatif::join('users', 'mst_alternatif.user_id', '=', 'users.id')->where('status', '=', 0)->get();
    	$detail = Det_Alternatif::orderBy('id_kriteria')->get();

    	return view('alternatif.index', compact('data', 'kriteria', 'detail'));
    }

    public function det_alternatif($id)
    {
    	$data = Det_Alternatif::join('kriteria', 'kriteria.id_kriteria', '=', 'det_alternatif.id_kriteria')->where('id_mst', '=', $id)->get();

    	return json_encode($data);
    }

    public function update($id)
    {
        $update = Mst_Alternatif::where('id_mst', '=', $id)->update([
            "tgl_penanganan"    => date("Y-m-d"),
            "status"            => '1'
        ]);;
        
        if ($update) {
            return redirect('perhitungan')->withStatus(__('Alternatif Berhasil Diupdate !!!'));
        } else {
            return redirect('perhitungan')->withStatus(__('Alternatif Gagal Diupdate !!!'));
        }
    }

    public function dataJalan()
    {
        $data = Mst_Alternatif::join('users', 'mst_alternatif.user_id', '=', 'users.id')->where('status', '=', '1')->get();

        return view('alternatif.index1', compact('data'));
    }
}
