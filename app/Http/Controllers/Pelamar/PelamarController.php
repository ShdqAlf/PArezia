<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LokerModel;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function index(){
        $lowongan = LokerModel::all();
        $data = [
            "lowongan"=> $lowongan
        ];
        return view('pelamar.lowongan', $data);
    }
}
