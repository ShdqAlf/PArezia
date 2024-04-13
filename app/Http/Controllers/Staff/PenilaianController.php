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
            $penilaian->pelamar_id = $request->input('pelamar_id');
            $penilaian->nilai = $nilai;
            $penilaian->save();
        }
        return redirect()->route('staff.dashboard')->with('success', 'Nilai berhasil ditambahkan');
    }
}
