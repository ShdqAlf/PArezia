<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\LokerModel;
use App\Models\PenilaianModel;
use App\Models\PelamarModel;
use App\Models\NilaiAkhirModel;

class PerhitunganController extends Controller
{
    public function index(Request $request)
    {
        $kriteria = KriteriaModel::all();
        $pilih_lowongan = $request->input('filter');
        $penilaian = PenilaianModel::whereHas('pelamar', function ($query) {
            $query->whereNotNull('lowongan_id');
        })->get();

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
        if ($pilih_lowongan) {
            $pelamar = PelamarModel::whereNotNull('lowongan_id')->whereNotNull('tes_id')->where('lowongan_id', $pilih_lowongan)->get();
            foreach ($pelamar as $pelamarItem) {
                // Periksa apakah kunci ada dalam array $multipliedByHalf dan $multipliedCrossByHalf sebelum mengaksesnya
                if (isset($multipliedByHalf[$pelamarItem->id]) && isset($multipliedCrossByHalf[$pelamarItem->id])) {
                    // Jika kunci ada, akses nilainya dan hitung $qiValues
                    $qiValues[$pelamarItem->id] = $multipliedByHalf[$pelamarItem->id] + $multipliedCrossByHalf[$pelamarItem->id];
                } else {
                    // Jika kunci tidak ada, mungkin ada kesalahan dalam pengambilan data atau perhitungan sebelumnya
                    // Anda bisa menangani kasus ini sesuai dengan kebutuhan aplikasi Anda, seperti memberikan nilai default atau menampilkan pesan kesalahan
                    // Contoh:
                    $qiValues[$pelamarItem->id] = null;
                    // atau
                    // throw new \Exception('Data tidak lengkap untuk menghitung nilai QI');
                }
            }
        } else {
            $pelamar = PelamarModel::whereNotNull('lowongan_id')->whereNotNull('tes_id')->get();;
        }
        $pelamarfilter = LokerModel::all();;
        arsort($qiValues);

        $ranking = [];
        $rank = 1;
        $prevQiValues = [];
        foreach ($qiValues as $pelamarId => $qi) {
            $lowonganId = PelamarModel::find($pelamarId)->lowongan_id;
            if (!isset($prevQiValues[$lowonganId])) {
                $prevQiValues[$lowonganId] = $qi;
            }
            if ($qi !== $prevQiValues[$lowonganId]) {
                $rank++;
            }
            $ranking[$pelamarId] = $rank;
            $prevQiValues[$lowonganId] = $qi;
        }

        $data = [
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'pelamar' => $pelamar,
            'pilih_lowongan' => $pilih_lowongan,
            'pelamarfilter' => $pelamarfilter,
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
