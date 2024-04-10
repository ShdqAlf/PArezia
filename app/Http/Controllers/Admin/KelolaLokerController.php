<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LokerModel;

class KelolaLokerController extends Controller
{
    public function index()
    {
        $lowongan = LokerModel::all();
        return view('admin.kelolaloker', compact('lowongan'));
    }

    public function tambahLoker(Request $request)
    {
        $Loker = new LokerModel();
        $Loker->judul = $request->judul;
        $Loker->posisi = $request->posisi;
        $Loker->minimal_pendidikan = $request->pendidikan;
        $Loker->minimal_pengalaman = $request->pengalaman;
        $Loker->usia_maks = $request->usia_maks;
        $Loker->keterangan = $request->keterangan;
        $Loker->save();

        return redirect()->route('admin.kelolaloker.index')->with('success', 'Lowongan berhasil ditambahkan');
    }
}
