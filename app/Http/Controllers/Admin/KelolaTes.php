<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TesKemampuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaTes extends Controller
{
    public function index()
    {
        $tesKemampuan = TesKemampuanModel::all();
        return view('admin.kelolates', compact('tesKemampuan'));
    }

    public function tambahTes(Request $request)
    {
        $tesKemampuan = new TesKemampuanModel();
        $tesKemampuan->pertanyaan = $request->pertanyaan;

        // Menyimpan
        if ($request->hasFile('file_download')) {
            $file = $request->file('file_download');
            $fileName = $file->getClientOriginalName();
            $tesKemampuan->file_download->move('image/file_tes/', $fileName);
        }
        $tesKemampuan->save();
        return redirect()->route('admin.kelolates.index')->with('success', 'Tes berhasil ditambahkan');
    }

    public function hapusTes($id)
    {
        $tesKemampuan = TesKemampuanModel::findOrFail($id);
        $tesKemampuan->delete();

        return redirect()->route('admin.kelolates.index')->with('success', 'Data tes berhasil dihapus');
    }
}
