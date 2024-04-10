<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LokerModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $expiredLowongans = LokerModel::where('status', 0)
            ->whereDate('tanggal_berakhir', '<', $now->toDateString())
            ->get();
        foreach ($expiredLowongans as $expiredLowongan) {
            $expiredLowongan->status = 1;
            $expiredLowongan->save();
        }

        $lowongans = LokerModel::where('status', 0)
            ->whereDate('tanggal_berakhir', '>=', $now->toDateString())
            ->get();
        $data = [
            "lowongans" => $lowongans
        ];
        return view('pelamar.lowongan', $data);
    }

}
