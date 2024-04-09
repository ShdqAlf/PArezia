<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\teskemampuanModel;
use Illuminate\Support\Facades\Storage;

class KelolaTes extends Controller
{
    public function index()
    {
        $tesKemampuan = teskemampuanModel::all();
        return view('admin.kelolates', compact('tesKemampuan'));
    }

    public function tambahTes(Request $request)
    {
        $tesKemampuan = new teskemampuanModel();
        $tesKemampuan->pertanyaan = $request->pertanyaan;

        // Menyimpan foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_tes', 'public');
            $tesKemampuan->foto = $fotoPath;
        }

        // Menyimpan file
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('file_tes', 'public');
            $tesKemampuan->file = $filePath;
        }

        $tesKemampuan->save();

        return redirect()->route('admin.kelolates.index')->with('success', 'Tes berhasil ditambahkan');
    }

    public function hapusTes($id)
    {
        $tesKemampuan = teskemampuanModel::findOrFail($id);
        $tesKemampuan->delete();

        return redirect()->route('admin.kelolates.index')->with('success', 'Data tes berhasil dihapus');
    }
}
