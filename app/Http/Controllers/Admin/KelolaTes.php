<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TesKemampuanModel;
use App\Models\LokerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaTes extends Controller
{
    public function index()
    {
        $tesKemampuan = TesKemampuanModel::all();
        $loker = LokerModel::all();

        $data = [
            'tesKemampuan' => $tesKemampuan,
            'loker' => $loker
        ];
        return view('admin.kelolates', $data);
    }

    public function tambahTes(Request $request)
    {
        // Menyimpan
        if ($request->hasFile('file_download')) {
            $file = $request->file('file_download');
            $fileName = $file->getClientOriginalName();
            $file->move('file_tes/', $fileName);
            $tesKemampuan = new TesKemampuanModel([
                'file_download' => $fileName,
                'keterangan' => $request->keterangan,
                'lowongan_id' => $request->judul,
            ]);
            $tesKemampuan->save();
        }
        return redirect()->route('admin.kelolates.index')->with('success', 'Tes berhasil ditambahkan');
    }

    public function hapusTes($id)
    {
        $tesKemampuan = TesKemampuanModel::findOrFail($id);
        $tesKemampuan->delete();

        return redirect()->route('admin.kelolates.index')->with('success', 'Data tes berhasil dihapus');
    }
}
