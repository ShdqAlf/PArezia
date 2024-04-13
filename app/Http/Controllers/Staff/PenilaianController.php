<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\TesModel;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        $teskemampuan = TesModel::all();
        $penilaian = PenilaianModel::whereIn('teskemampuan_id', $teskemampuan->pluck('id'))->get();
        $data = [
            'kriteria' => $kriteria,
            'teskemampuan' => $teskemampuan,
            'penilaian' => $penilaian,
        ];
        return view('staff.kelolapenilaian', $data);
    }

    public function tambah(Request $request)
    {
        // Membuat array kosong untuk menyimpan nilai-nilai
        $nilaiArray = [];

        // Mengambil nilai-nilai dari request dan menyimpannya ke dalam array
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'nilai_') !== false) {
                $nilaiArray[substr($key, 6)] = $value;
            }
        }

        // Menyimpan nilai-nilai ke dalam database
        foreach ($nilaiArray as $kriteria_id => $nilai) {
            $penilaian = new PenilaianModel();
            $penilaian->kriteria_id = $kriteria_id; // Menggunakan $kriteria_id
            $penilaian->teskemampuan_id = $request->input('teskemampuan_id');
            $penilaian->nilai = $nilai;
            $penilaian->save();
        }
        return redirect()->route('staff.dashboard')->with('success', 'Nilai berhasil ditambahkan');
    }
}
