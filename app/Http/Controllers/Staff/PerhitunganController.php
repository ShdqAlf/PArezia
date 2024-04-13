<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\PelamarModel;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        $penilaian = PenilaianModel::all();
        $pelamar = PelamarModel::whereNotNull('lowongan_id')->whereNotNull('tes_id')->get();

        // Initialize arrays to store maximum and minimum values
        $max = [];
        $min = [];
        $sum = [];

        // Calculate maximum and minimum values for each criterion
        foreach ($kriteria as $kriteriaItem) {
            $max[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->max('nilai');
            $min[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->min('nilai');
        }

        // Prepare data for view
        $data = [];

        // Loop through penilaian to perform calculations
        foreach ($penilaian as $penilaianItem) {
            $kriteriaItem = $kriteria->where('id', $penilaianItem->kriteria_id)->first();
            $jenisKriteria = $kriteriaItem->jenis_kriteria;
            $nilaiMax = $max[$penilaianItem->kriteria_id];
            $nilaiMin = $min[$penilaianItem->kriteria_id];
            $perhitungan = 0;

            if ($jenisKriteria === 'Benefit') {
                $perhitungan = $penilaianItem->nilai / $nilaiMax;
            } elseif ($jenisKriteria === 'Cost') {
                $perhitungan = $nilaiMin / $penilaianItem->nilai;
            }

            // Calculate nilai bobot
            $nilaiBobot = $perhitungan * $kriteriaItem->nilai_bobot;

            // Sum up the nilai bobot based on pelamar_id
            if (!isset($sum[$penilaianItem->pelamar_id])) {
                $sum[$penilaianItem->pelamar_id] = 0;
            }
            $sum[$penilaianItem->pelamar_id] += $nilaiBobot;

            // Store calculated values in penilaianItem
            $penilaianItem->perhitungan = $perhitungan;
            $penilaianItem->nilai_bobot = $nilaiBobot;
        }

        // Pass necessary data to the view
        $data = [
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'pelamar' => $pelamar,
            'max' => $max,
            'min' => $min,
            'sum' => $sum,
        ];

        return view('staff.kelolaperhitungan', $data);
    }
}
