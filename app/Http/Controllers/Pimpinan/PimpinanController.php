<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\LokerModel;
use App\Models\PelamarModel;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index(Request $request)
    {
        $pilih_lowongan = $request->input('filter');
        if ($pilih_lowongan) {
            $laporan = PelamarModel::whereNotNull(['status_tes'])->where('lowongan_id', $pilih_lowongan)->get();
        } else {
            $laporan = PelamarModel::whereNotNull(['status_tes'])->get();
        }
        $laporanfilter = LokerModel::all();
        $data = [
            'laporan' => $laporan,
            'laporanfilter' => $laporanfilter,
            'pilih_lowongan' => $pilih_lowongan,
        ];
        return view("pimpinan.laporan", $data);
    }
}
