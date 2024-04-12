<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\PelamarModel;
use App\Models\TesKemampuanModel;
use Illuminate\Http\Request;

class LaporanHasilController extends Controller
{
    public function index(){
        $auth = auth()->user();
        $pelamar = PelamarModel::where('user_id', $auth->id)->first();
        $hasil = TesKemampuanModel::where('pelamar_id', $pelamar->id)->get();
        $data = [
            'hasil'=> $hasil,
            'pelamar'=> $pelamar,
        ];
        return view("pelamar.laporanhasil", $data);
    }
}
