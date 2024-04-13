<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LokerModel;
use App\Models\PelamarModel;
use App\Models\TesModel;
use Illuminate\Http\Request;

class TesController extends Controller
{
    public function index($id)
    {
        $user_id = auth()->user();
        $pelamar = PelamarModel::where('user_id', $user_id->id)->first();
        $lowongan = LokerModel::find($id);
        $tes = TesModel::where('lowongan_id', $lowongan->id)->first();
        $data = [
            'tes' => $tes,
            'pelamar' => $pelamar,
        ];
        return view('pelamar.teskemampuan', $data);
    }

    public function download_file($file)
    {
        return response()->download(public_path('file_tes/' . $file));
    }

    public function uploadFile(Request $request, $id)
    {
        $user_id = auth()->user();
        $Idpelamar = PelamarModel::where('user_id', $user_id->id)->first();
        $pelamar = PelamarModel::find($Idpelamar->id);
        $tes = TesModel::find($id);
        $request->validate([
            'file_upload' => 'required|mimes:pdf,word,zip,rar|max:5080',
        ], [
            'file_upload.required' => 'File Wajib Diisi.',
            'file_upload.mimes' => 'Format File Wajib Berupa PDF,WORD,ZIP, dan RAR.',
            'file_upload.max' => 'Ukuran File Maksimal 5MB.',
        ]);
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = $file->getClientOriginalName();
            $file->storeAs('file_upload/', $filename, 'public');
            $pelamar->file_upload = $filename;
            $pelamar->tes_id = $tes;
            $pelamar->save();
            alert()->success('Tes Berhasil Diupload');
            return redirect()->route('pelamar.dashboard');
        } else {
            alert()->error('File Gagal Menyimpan');
            return redirect()->back();
        }
    }
}
