<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\PelamarModel;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index()
    {
        $laporan = PelamarModel::whereNotNull(['status_tes'])->get();
        $data = [
            'laporan' => $laporan
        ];
        return view("pimpinan.laporan", $data);
    }
}
