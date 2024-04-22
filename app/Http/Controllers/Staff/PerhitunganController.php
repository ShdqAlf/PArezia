<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\PelamarModel;
use App\Models\NilaiAkhirModel;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        $penilaian = PenilaianModel::all();
        $pelamar = PelamarModel::whereNotNull('lowongan_id')->whereNotNull('tes_id')->get();
        $max = [];
        $min = [];
        foreach ($kriteria as $kriteriaItem) {
            $max[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->max('nilai');
            $min[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->min('nilai');
        }
        $data = [];
        $multipliedValues = [];
        $poweredValues = [];
        $summedValues = [];
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
            $penilaianItem->perhitungan = $perhitungan;
            $nilaiBobot = $kriteriaItem->nilai_bobot;
            $multipliedValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id] = $perhitungan * $nilaiBobot;
            $poweredValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id] = pow($perhitungan, $nilaiBobot);
            if (!isset($summedValues[$penilaianItem->pelamar_id])) {
                $summedValues[$penilaianItem->pelamar_id] = 0;
            }
            $summedValues[$penilaianItem->pelamar_id] += $multipliedValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id];
        }
        $multipliedByHalf = [];
        foreach ($summedValues as $pelamarId => $summedValue) {
            $multipliedByHalf[$pelamarId] = $summedValue * 0.5;
        }
        $crossValues = [];
        foreach ($poweredValues as $pelamarId => $criteriaValues) {
            $crossValues[$pelamarId] = array_product($criteriaValues);
        }
        $multipliedCrossByHalf = [];
        foreach ($crossValues as $pelamarId => $crossValue) {
            $multipliedCrossByHalf[$pelamarId] = $crossValue * 0.5;
        }
        $qiValues = [];
        foreach ($pelamar as $pelamarItem) {
            $qiValues[$pelamarItem->id] = $multipliedByHalf[$pelamarItem->id] + $multipliedCrossByHalf[$pelamarItem->id];
        }
        arsort($qiValues);

        $ranking = [];
        // Inisialisasi peringkat
        $rank = 1;
        // Array untuk menyimpan nilai QI sebelumnya untuk setiap lowongan_id
        $prevQiValues = [];
        foreach ($qiValues as $pelamarId => $qi) {
            // Dapatkan lowongan_id dari pelamar
            $lowonganId = PelamarModel::find($pelamarId)->lowongan_id;

            // Jika belum ada nilai QI sebelumnya untuk lowongan_id ini, inisialisasi dengan nilai QI saat ini
            if (!isset($prevQiValues[$lowonganId])) {
                $prevQiValues[$lowonganId] = $qi;
            }

            // Periksa apakah QI saat ini sama dengan QI sebelumnya untuk lowongan_id ini
            if ($qi !== $prevQiValues[$lowonganId]) {
                // Jika tidak, tingkatkan peringkat
                $rank++;
            }

            // Simpan peringkat untuk pelamar ini
            $ranking[$pelamarId] = $rank;

            // Simpan nilai QI saat ini sebagai nilai QI sebelumnya untuk lowongan_id ini
            $prevQiValues[$lowonganId] = $qi;
        }

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



    public function simpanNilai()
    {
        $kriteria = KriteriaModel::all();
        $penilaian = PenilaianModel::all();
        $pelamar = PelamarModel::whereNotNull('lowongan_id')->whereNotNull('tes_id')->get();
        $max = [];
        $min = [];
        foreach ($kriteria as $kriteriaItem) {
            $max[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->max('nilai');
            $min[$kriteriaItem->id] = PenilaianModel::where('kriteria_id', $kriteriaItem->id)->min('nilai');
        }
        $data = [];
        $multipliedValues = [];
        $poweredValues = [];
        $summedValues = [];
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
            $penilaianItem->perhitungan = $perhitungan;
            $nilaiBobot = $kriteriaItem->nilai_bobot;
            $multipliedValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id] = $perhitungan * $nilaiBobot;
            $poweredValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id] = pow($perhitungan, $nilaiBobot);
            if (!isset($summedValues[$penilaianItem->pelamar_id])) {
                $summedValues[$penilaianItem->pelamar_id] = 0;
            }
            $summedValues[$penilaianItem->pelamar_id] += $multipliedValues[$penilaianItem->pelamar_id][$penilaianItem->kriteria_id];
        }
        $multipliedByHalf = [];
        foreach ($summedValues as $pelamarId => $summedValue) {
            $multipliedByHalf[$pelamarId] = $summedValue * 0.5;
        }
        $crossValues = [];
        foreach ($poweredValues as $pelamarId => $criteriaValues) {
            $crossValues[$pelamarId] = array_product($criteriaValues);
        }
        $multipliedCrossByHalf = [];
        foreach ($crossValues as $pelamarId => $crossValue) {
            $multipliedCrossByHalf[$pelamarId] = $crossValue * 0.5;
        }
        $qiValues = [];
        foreach ($pelamar as $pelamarItem) {
            $qiValues[$pelamarItem->id] = $multipliedByHalf[$pelamarItem->id] + $multipliedCrossByHalf[$pelamarItem->id];
        }
        arsort($qiValues);

        $ranking = [];
        // Inisialisasi peringkat
        $rank = 1;
        // Array untuk menyimpan nilai QI sebelumnya untuk setiap lowongan_id
        $prevQiValues = [];
        foreach ($qiValues as $pelamarId => $qi) {
            // Dapatkan lowongan_id dari pelamar
            $lowonganId = PelamarModel::find($pelamarId)->lowongan_id;

            // Jika belum ada nilai QI sebelumnya untuk lowongan_id ini, inisialisasi dengan nilai QI saat ini
            if (!isset($prevQiValues[$lowonganId])) {
                $prevQiValues[$lowonganId] = $qi;
            }

            // Periksa apakah QI saat ini sama dengan QI sebelumnya untuk lowongan_id ini
            if ($qi !== $prevQiValues[$lowonganId]) {
                // Jika tidak, tingkatkan peringkat
                $rank++;
            }

            // Simpan peringkat untuk pelamar ini
            $ranking[$pelamarId] = $rank;

            // Simpan nilai QI saat ini sebagai nilai QI sebelumnya untuk lowongan_id ini
            $prevQiValues[$lowonganId] = $qi;
        }

        foreach ($pelamar as $pelamarItem) {
            $qiValue = $qiValues[$pelamarItem->id];
            $rankingValue = $ranking[$pelamarItem->id];
            $nilaiAkhir = new NilaiAkhirModel();
            $nilaiAkhir->pelamar_id = $pelamarItem->id;
            $nilaiAkhir->nilaiqi = $qiValue;
            $nilaiAkhir->rangking = $rankingValue;
            $nilaiAkhir->save();
        }
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
        alert()->success('Nilai Berhasil Disimpan');
        return redirect()->back();
    }
}
