<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LokerModel;
use App\Models\PelamarModel;
use App\Models\Syarat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $auth = auth()->user();
        $pelamar = PelamarModel::where('user_id', $auth->id)->first();
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
            "lowongans" => $lowongans,
            "pelamar" => $pelamar,
        ];
        return view('pelamar.lowongan', $data);
    }


    public function upload_syarat(Request $request)
    {
        $auth = auth()->user();
        $pelamar = PelamarModel::where('user_id', $auth->id)->first();
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2000',
            'dokumen_lainnya' => 'required|mimes:zip|max:5000',
        ], [
            'cv.required' => 'CV harus diisi',
            'dokumen_lainnya.required' => 'Dokumen Tambahan harus diisi',
            'dokumen_lainnya.mimes' => 'Dokumen Tambahan wajib format ZIP.',
            'cv.mimes' => 'CV wajib format PDF.',
            'cv.max' => 'CV tidak berukuran maksimal 2MB.',
            'dokumen_lainnya.max' => 'Dokumen Tambahan tidak berukuran maksimal 5MB.',
        ]);
        $lowongan_id = $request->input('lowongan_id');
        if ($request->hasFile('cv') && $request->hasFile('dokumen_lainnya')) {
            $cv = $request->file('cv');
            $dokumen_lainnya = $request->file('dokumen_lainnya');
            $filenamecv = $cv->getClientOriginalName();
            $cv->storeAs('syarat/cv/', $filenamecv, 'public');
            $filenamedokumen = $dokumen_lainnya->getClientOriginalName();
            $dokumen_lainnya->storeAs('syarat/dokumen_tambahan/', $filenamedokumen, 'public');
            $data = new Syarat([
                'pelamar_id' => $pelamar->id,
                'lowongan_id' => $lowongan_id,
                'cv' => $filenamecv,
                'dokumen_lainnya' => $filenamedokumen,
            ]);
            $data->Save();
            alert()->success('Tes Berhasil Diupload');
            return redirect()->route('pelamar.test.kemampuan');
        }
    }
}
