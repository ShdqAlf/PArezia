<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LokerModel;
use App\Models\TesKemampuanModel;
use Illuminate\Http\Request;

class TesController extends Controller
{
    public function index($id){
        $lowongan = LokerModel::find($id);
        $tes = TesKemampuanModel::where('lowongan_id', $lowongan->id)->get();
        $data = [
            'tes'=>$tes,
            'lowongan'=>$lowongan,
        ];
        return view('pelamar.teskemampuan', $data);
    }
}
