<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Subkriteria;
use App\Mst_Alternatif;
use App\Det_Alternatif;
use App\Penilaian;
use App\User;
use App\HasilAkhir;
use DB;

class PerhitunganController extends Controller
{
	public function index()
	{
		$hitung = $this->hitung();

		if ($hitung) {
			$kriteria = Kriteria::all();
			$penilaian = Penilaian::all();
			// $alternatif = Mst_Alternatif::join('vw_hasil_akhir', 'mst_alternatif.id_mst', '=', 'vw_hasil_akhir.id_alternatif')->orderBy('hasil', 'desc')->get();
			$alternatif = Mst_Alternatif::select('id_mst', DB::raw('SUM(hasil) as hasil'))->join('penilaian', 'mst_alternatif.id_mst', '=', 'penilaian.id_alternatif')->where('status', '=', '0')->groupBy('mst_alternatif.id_mst')->orderBy('hasil', 'desc')->get();

			return view('perhitungan.index', compact('kriteria', 'penilaian', 'alternatif'));
			// print_r(count($alternatif));
		} else {
			return back()->withStatus(__('Penghitungan Gagal, Silahkan Coba Lagi !!!'));
		}
	}

	public function hitung()
	{
		$kriteria = Kriteria::all();
		$clear = Penilaian::truncate();
		$min_max = Det_Alternatif::select(DB::raw("id_kriteria, max(nilai) as nilai_max, min(nilai) as nilai_min"))->groupBy('id_kriteria')->get();
		$det_alternatif = Det_Alternatif::all();
		$c_max=array();
		$c_min=array();
		foreach ($min_max as $i => $value) {
			$c_max[$i] = $value->nilai_max;
			$c_min[$i] = $value->nilai_min;
		}
		$hitung;

		if ($clear) {
			foreach ($kriteria as $a => $k) {
				foreach ($det_alternatif as $b => $v) {
					if ($v->id_kriteria == $k->id_kriteria) {
						$hitung = (($v->nilai - $c_min[$a])/($c_max[$a] - $c_min[$a]));
						$insert = Penilaian::insert([
							'id_alternatif'	=> $v->id_mst,
							'id_kriteria'	=> $v->id_kriteria,
							'nilai_utility'	=> number_format($hitung, 3),
							'normalisasi_kriteria' => $k->normalisasi,
							'hasil'			=> round((number_format($hitung, 3)*$k->normalisasi), 3)
						]);
					}
				}
			}
		}

		if ($insert) {
			return true;
		} else {
			return false;
		}
	}
}
