<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;

class KriteriaController extends Controller
{
	public function index()
	{
		$data = Kriteria::all();
		return view('kriteria.index', compact('data'));
	}

	public function create()
	{
		return view('kriteria.create');
	}

	public function store(Request $request)
	{
		$data = $request->all();
		$create = Kriteria::create($data);

		if ($create) {
			$kriteria = Kriteria::all();
			$total_bobot = Kriteria::sum('bobot');

			for ($i=0; $i < count($kriteria); $i++) { 
				$normalisasi[$i] = $kriteria[$i]->bobot / $total_bobot;
				$update = Kriteria::where('id_kriteria', '=', $kriteria[$i]->id_kriteria)
				->update([
					'normalisasi'	=> number_format($normalisasi[$i], 3)
				]);
			}

			if ($update) {
				return redirect()->route('kriteria.index')->withStatus(__('Kriteria Berhasil Disimpan.'));
			} else {
				return redirect()->route('kriteria.index')->withStatus(__('Kriteria Gagal Disimpan.'));
			}
		} else {
			return redirect()->route('kriteria.index')->withStatus(__('Kriteria Gagal Disimpan.'));
		}
	}

	public function edit($id)
	{
		$data = Kriteria::where('id_kriteria', '=', $id)->first();

		return view('kriteria.edit', compact('data'));
	}

	public function update(Request $request, $id)
	{
		$update = Kriteria::where('id_kriteria', '=', $id)->update([
			'nama_kriteria'	=> $request->nama_kriteria,
			'bobot'			=> $request->bobot
		]);

		if ($update) {
			$kriteria = Kriteria::all();
			$total_bobot = Kriteria::sum('bobot');

			for ($i=0; $i < count($kriteria); $i++) { 
				$normalisasi[$i] = $kriteria[$i]->bobot / $total_bobot;
				$update = Kriteria::where('id_kriteria', '=', $kriteria[$i]->id_kriteria)
				->update([
					'normalisasi'	=> number_format($normalisasi[$i], 3)
				]);
			}

			if ($update) {
				return redirect()->route('kriteria.index')->withStatus(__('Kriteria successfully updated.'));
			} else {
				return redirect()->route('kriteria.index')->withStatus(__('Kriteria update failed.'));
			}
		} else {
			return redirect()->route('kriteria.index')->withStatus(__('Kriteria update failed.'));
		}
	}

	public function destroy($id)
	{
		$delete = Kriteria::where('id_kriteria', '=', $id)->delete();

		if ($delete) {
			$kriteria = Kriteria::all();
			$total_bobot = Kriteria::sum('bobot');

			for ($i=0; $i < count($kriteria); $i++) { 
				$normalisasi[$i] = $kriteria[$i]->bobot / $total_bobot;
				$update = Kriteria::where('id_kriteria', '=', $kriteria[$i]->id_kriteria)
				->update([
					'normalisasi'	=> number_format($normalisasi[$i], 3)
				]);
			}

			if ($update) {
				return redirect()->route('kriteria.index')->withStatus(__('Kriteria successfully deleted.'));
			} else {
				return redirect()->route('kriteria.index')->withStatus(__('Kriteria delete failed.'));
			}
		} else {
			return redirect()->route('kriteria.index')->withStatus(__('Kriteria delete failed.'));
		}
	}

}
