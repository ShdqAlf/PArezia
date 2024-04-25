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

    public function syarat($id){
        $auth = auth()->user();
        $pelamar = PelamarModel::where('user_id', $auth->id)->first();
        $lowongan = LokerModel::find($id);
        $data = [
            "pelamar" => $pelamar,
            "lowongan" => $lowongan,
        ];
        return view('pelamar.syarat', $data);
    }
    public function profil(){
        $auth = auth()->user();
        $pelamar = PelamarModel::where('user_id', $auth->id)->first();
        $data = [
            "pelamar" => $pelamar,
        ];
        return view('pelamar.profil', $data);
    }

    public function edit_profil(Request $request)
    {
        $user = auth()->id();
        $request->validate([
            'foto_profil' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'foto_profil.image' => 'File harus berupa gambar',
            'foto_profil.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg',
            'foto_profil.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);
        $pelamar = PelamarModel::where('user_id', $user)->first();
        $pelamar->nama = $request->input('nama');
        $pelamar->no_hp = $request->input('no_hp');
        $pelamar->tempat_lahir = $request->input('tempat_lahir');
        $pelamar->tanggal_lahir = $request->input('tanggal_lahir');
        $pelamar->alamat = $request->input('alamat');
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');

            if ($file->isValid()) {
                $fotoName = uniqid() . '.' . $file->getClientOriginalExtension();
                $path = 'foto_profil/' . $fotoName;
                $success = file_put_contents($path, file_get_contents($file->getRealPath()));
                if ($success !== false) {
                    $pelamar->foto_profil = $path;
                } else {
                    alert()->toast('Gagal menyimpan file', 'error');
                    return redirect()->back();
                }
            } else {
                alert()->toast('File tidak valid', 'error');
                return redirect()->back();
            }
        }
        if ($pelamar->save()) {
            alert()->toast('Profil berhasil dirubah', 'success');
            return redirect()->back();
        } else {
            alert()->toast('Profil tidak berhasil dirubah', 'error');
            return redirect()->back();
        }
    }

    public function upload_syarat(Request $request)
    {
        $auth = auth()->user();
        $pelamar = PelamarModel::where('user_id', $auth->id)->first();
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2000',
            'dokumen_lainnya' => 'required|mimes:zip,rar',
        ], [
            'cv.required' => 'CV harus diisi',
            'dokumen_lainnya.required' => 'Dokumen Tambahan harus diisi',
            'dokumen_lainnya.mimes' => 'Dokumen Tambahan wajib format ZIP atau RAR.',
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
                'lowongan_id' => $lowongan_id,
                'pengalaman_terakhir' => $request->input('pengalaman_terakhir'),
                'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
                'cv' => $filenamecv,
                'dokumen_lainnya' => $filenamedokumen,
            ]);
            $data->Save();
            alert()->success('Syarat Berhasil Diupload');
            return redirect()->route('pelamar.test.kemampuan', $data->id);
        }
    }
}
