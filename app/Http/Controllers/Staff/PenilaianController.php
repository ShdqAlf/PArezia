<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\TesKemampuanModel;
use App\Models\PenilaianModel;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = [
            'kriteria' => KriteriaModel::all(),
            'teskemampuan' => TesKemampuanModel::all(),
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
        return redirect()->route('staff.kelolapenilaian')->with('success', 'Nilai berhasil ditambahkan');
    }
}
