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

        // Calculate maximum and minimum values for each criterion
        foreach ($kriteria as $kriteriaItem) {
            $max[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->max('nilai');
            $min[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->min('nilai');
        }

        // Prepare data for view
        $data = [];

        // Initialize arrays to store multiplied and powered values
        $multipliedValues = [];
        $poweredValues = [];

        // Initialize array to store summed values
        $summedValues = [];

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

            // Store calculated values in penilaianItem
            $penilaianItem->perhitungan = $perhitungan;

            // Multiply perhitungan with nilai_bobot
            $nilaiBobot = $kriteriaItem->nilai_bobot;
            $multipliedValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id] = $perhitungan * $nilaiBobot;

            // Power perhitungan with nilai_bobot
            $poweredValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id] = pow($perhitungan, $nilaiBobot);

            // Check if the summed value for this pelamar_id has been initialized
            if (!isset($summedValues[$penilaianItem->pelamar_id])) {
                $summedValues[$penilaianItem->pelamar_id] = 0;
            }

            // Add the multiplied value to the existing summed value
            $summedValues[$penilaianItem->pelamar_id] += $multipliedValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id];
        }

        // Initialize array to store multiplied values with 0.5
        $multipliedByHalf = [];

        // Loop through summed values to perform multiplication by 0.5
        foreach ($summedValues as $pelamarId => $summedValue) {
            // Multiply the summed value by 0.5
            $multipliedByHalf[$pelamarId] = $summedValue * 0.5;
        }

        // Initialize array to store CROSS values
        $crossValues = [];

        // Loop through powered values to perform multiplication
        foreach ($poweredValues as $pelamarId => $criteriaValues) {
            $crossValues[$pelamarId] = array_product($criteriaValues);
        }

        // Initialize array to store multiplied CROSS values with 0.5
        $multipliedCrossByHalf = [];

        // Loop through CROSS values to perform multiplication by 0.5
        foreach ($crossValues as $pelamarId => $crossValue) {
            // Multiply the CROSS value by 0.5
            $multipliedCrossByHalf[$pelamarId] = $crossValue * 0.5;
        }

        // Initialize array to store QI values
        $qiValues = [];

        // Loop through pelamar to calculate QI values
        foreach ($pelamar as $pelamarItem) {
            // Calculate QI value
            $qiValues[$pelamarItem->id] = $multipliedByHalf[$pelamarItem->id] + $multipliedCrossByHalf[$pelamarItem->id];
        }

        // Sort QI values in descending order
        arsort($qiValues);

        // Initialize array to store ranking values
        $ranking = [];

        // Calculate ranking
        $rank = 1;
        $prevQi = null;
        foreach ($qiValues as $pelamarId => $qi) {
            if ($prevQi !== null && $qi !== $prevQi) {
                $rank++;
            }
            $ranking[$pelamarId] = $rank;
            $prevQi = $qi;
        }

        // Pass necessary data to the view
        $data = [
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'pelamar' => $pelamar,
            'max' => $max,
            'min' => $min,
            'multipliedValues' => $multipliedValues,
            'poweredValues' => $poweredValues,
            'summedValues' => $summedValues,
            'multipliedByHalf' => $multipliedByHalf,
            'crossValues' => $crossValues,
            'multipliedCrossByHalf' => $multipliedCrossByHalf,
            'qiValues' => $qiValues,
            'ranking' => $ranking,
        ];

        return view('staff.kelolaperhitungan', $data);
    }
}
