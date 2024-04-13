<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;

class KelolaKriteriaController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        return view('admin.kelolakriteria', compact('kriteria'));
    }

    public function tambah(Request $request)
    {
        $data = $request->all();
        $pelamar = KriteriaModel::create($data);
        $pelamar->save();

        return redirect()->route('admin.kelolakriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $loker = KriteriaModel::findOrFail($id);
        $loker->delete();

        return redirect()->route('admin.kelolakriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }

    public function edit(Request $request, KriteriaModel $row)
    {
        $row->update([
            'nama_kriteria' => $request->nama_kriteria,
            'kode_bobot' => $request->kode_bobot,
            'nilai_bobot' => $request->nilai_bobot,
            'jenis_kriteria' => $request->jenis_kriteria,
        ]);

        return redirect()->route('admin.kelolakriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }
}
