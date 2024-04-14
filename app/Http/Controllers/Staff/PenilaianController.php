<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\TesModel;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\PelamarModel;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        $penilaian = PenilaianModel::all();
        $pelamar = PelamarModel::whereNotNull('lowongan_id')->whereNotNull('tes_id')->get();
        $data = [
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'pelamar' => $pelamar,
        ];
        return view('staff.kelolapenilaian', $data);
    }

    public function tambah(Request $request)
    {
        $nilaiArray = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'nilai_') !== false) {
                $nilaiArray[substr($key, 6)] = $value;
            }
        }
        foreach ($nilaiArray as $kriteria_id => $nilai) {
            $penilaian = new PenilaianModel();
            $penilaian->kriteria_id = $kriteria_id;
            $penilaian->pelamar_id = $request->input('pelamar_id');
            $penilaian->nilai = $nilai;
            $penilaian->save();
        }
        alert()->success('Penilaian Berhasil');
        return redirect()->back();
    }
    public function edit(Request $request)
    {
        $nilaiArray = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'nilai_') !== false) {
                $nilaiArray[substr($key, 6)] = $value;
            }
        }
        foreach ($nilaiArray as $kriteria_id => $nilai) {
            $penilaian = PenilaianModel::where('kriteria_id', $kriteria_id)
                ->where('pelamar_id', $request->input('pelamar_id'))
                ->first();
            if ($penilaian) {
                $penilaian->nilai = $nilai;
                $penilaian->save();
            } else {
                $penilaian = new PenilaianModel();
                $penilaian->kriteria_id = $kriteria_id;
                $penilaian->pelamar_id = $request->input('pelamar_id');
                $penilaian->nilai = $nilai;
                $penilaian->save();
            }
        }
        alert()->success('Penilaian Berhasil Dirubah');
        return redirect()->back();
    }
}
