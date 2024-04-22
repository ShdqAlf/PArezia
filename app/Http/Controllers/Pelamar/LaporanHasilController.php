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
<<<<<<< HEAD
        $pelamar = PelamarModel::where('user_id', $auth->id)->first();
        $hasil = TesModel::where('pelamar_id', $pelamar->id)->get();
        $data = [
            'hasil' => $hasil,
=======
        $pelamar = PelamarModel::where('user_id', $auth->id)->where('isBatal', false)->first();
        $data = [
>>>>>>> f970d50d90a2e56bc7951e6ab7dc1d38743e4f2e
            'pelamar' => $pelamar,
        ];
        return view("pelamar.laporanhasil", $data);
    }

    public function batal_tes($id)
    {
        $pelamar = PelamarModel::find($id);
        $pelamar->lowongan_id = null;
        $pelamar->tes_id = null;
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
