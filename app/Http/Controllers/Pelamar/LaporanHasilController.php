<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\NIlaiAkhirModel;
use App\Models\PelamarModel;
use App\Models\TesModel;
use Illuminate\Http\Request;

class LaporanHasilController extends Controller
{
    public function index()
    {
        $auth = auth()->user();
        $pelamarId = PelamarModel::where('user_id', $auth->id)->first();
        $pelamar = PelamarModel::whereNotNull('lowongan_id')->whereNotNull('tes_id')->where('lowongan_id', $pelamarId->lowongan_id)->where('status_tes', 'Diterima')->get();
        $data = [
            'pelamar' => $pelamar,
        ];
        return view("pelamar.laporanhasil", $data);
    }

    public function batal_tes($id)
    {
        $pelamar = PelamarModel::find($id);
        $pelamar->lowongan_id = null;
        $pelamar->tes_id = null;
        $pelamar->syarat_id = null;
        $pelamar->isBatal = true;
        $pelamar->file_upload = null;
        if ($pelamar->save()) {
            $nilai = NIlaiAkhirModel::where('pelamar_id', $pelamar->id);
            $nilai->delete();
            alert()->success('Batal Tes berhasil');
            return redirect()->back();
        }
    }
}
