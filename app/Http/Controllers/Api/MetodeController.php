<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kriteria;
use App\Subkriteria;
use App\Mst_Alternatif;
use App\Det_Alternatif;
use Auth;

class MetodeController extends Controller
{
	public function index()
	{
		$kriteria = Kriteria::all();
		$subkriteria = Subkriteria::all();

		if (count($kriteria) > 0) {
			return response()->json(compact('kriteria', 'subkriteria'), 200);
		} else {
			return response(['statusCode' => 400, 'message' => "Data Tidak Ditemukan."], 401);
		}
	}

	public function input(Request $request)
	{
		$decode_image = base64_decode($request->gambar);
		$f = finfo_open();

		$mime_type = finfo_buffer($f, $decode_image, FILEINFO_MIME_TYPE);
		$extension = explode('/', $mime_type);

		$nama_gbr = uniqid().".".$extension[1];

		$p = \Storage::put('/public/images/' . $nama_gbr, base64_decode($request->gambar), 0775);

		$id_kriteria 	= explode(";", $request->id_kriteria);
		$nilai 			= explode(";", $request->nilai);

		if ($p) {
			$mst = Mst_Alternatif::insertGetId([
				'lat'				=> $request->lat,
				'lang'				=> $request->lang,
				'tgl_input'			=> $request->tgl_input,
				'gambar'			=> $nama_gbr,
				'status'			=> 0,
				'user_id'			=> Auth::user()->id
			]);

			if ($mst > 0) {
				for ($i=0; $i < count($id_kriteria); $i++) { 
					$det = Det_Alternatif::insert([
						'id_mst'		=> $mst,
						'id_kriteria'	=> $id_kriteria[$i],
						'nilai'			=> $nilai[$i],
					]);
				}

				if ($det) {
					return response(['message' => "Input Data Berhasil"], 200);
				} else {
					return response(['statusCode' => 400, 'message' => "Gagal input data detail."], 401);		
				}
			} else {
				return response(['statusCode' => 400, 'message' => "Gagal input data master."], 401);	
			}
		} else {
			return response(['statusCode' => 400, 'message' => "Gagal upload gambar."], 401);
		}
	}

	public function dataJalan(Request $request)
    {
        $status = $request->status;
        if ($status == "lubang") {
        	$data = Mst_Alternatif::join('users', 'mst_alternatif.user_id', '=', 'users.id')->where('status', '=', '0')->get();
        } else if ($status == "proses") {
        	$data = Mst_Alternatif::join('users', 'mst_alternatif.user_id', '=', 'users.id')->where('status', '=', '1')->get();
        } else {
        	$data = Mst_Alternatif::join('users', 'mst_alternatif.user_id', '=', 'users.id')->where('users.id', '=', $status)->get();
        }

        if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response(['statusCode' => 400, 'message' => "Data Tidak Ditemukan."], 401);
		}
    }
}
