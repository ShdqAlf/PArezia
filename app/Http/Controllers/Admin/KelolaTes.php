<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TesModel;
use App\Models\LokerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaTes extends Controller
{
    public function index()
    {
        $tesKemampuan = TesModel::all();
        $loker = LokerModel::all();

        $data = [
            'tesKemampuan' => $tesKemampuan,
            'loker' => $loker
        ];
        return view('admin.kelolates', $data);
    }

    public function tambahTes(Request $request)
    {
        $tesKemampuan = new TesModel();
        $tesKemampuan->keterangan = $request->keterangan;
        $tesKemampuan->lowongan_id = $request->judul;
        $tesKemampuan->url = $request->url;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('file_tes', $fileName, 'public');
            $tesKemampuan->file_download = $fileName;
        }
        $tesKemampuan->save();
        return redirect()->route('admin.kelolates.index')->with('success', 'Tes berhasil ditambahkan');
    }

    public function hapusTes($id)
    {
        $tesKemampuan = TesModel::findOrFail($id);
        $tesKemampuan->delete();

        return redirect()->route('admin.kelolates.index')->with('success', 'Data tes berhasil dihapus');
    }

    public function edit(Request $request, TesModel $tes)
    {
        $tes->update([
            'keterangan' => $request->keterangan,
            'lowongan_id' => $request->judul,
            'url' => $request->url,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('file_tes', $fileName, 'public');
            $tes->file_download = $filePath;
        }

        $tes->save();

        return redirect()->route('admin.kelolates.index')->with('success', 'Data tes berhasil diubah');
    }
}
