<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Elibyy\TCPDF\Facades\TCPDF;

use App\Http\Controllers\Controller;
use App\Models\NIlaiAkhirModel;
use App\Models\PelamarModel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $pelamar = PelamarModel::whereNotNull(['lowongan_id', 'tes_id'])->get();
        $laporan = PelamarModel::whereNotNull(['status_tes'])->get();
        $data = [
            'pelamar' => $pelamar,
            'laporan' => $laporan
        ];
        return view("admin.laporan", $data);
    }

    public function diterima($id)
    {
        $pelamar = PelamarModel::findOrFail($id);
        $pelamar->status_tes = 'Diterima';
        $pelamar->save();
        alert()->success('Pelamar berhasil diterima');
        return redirect()->back();
    }

    public function ditolak($id)
    {
        $pelamar = PelamarModel::findOrFail($id);
        $pelamar->status_tes = 'Ditolak';
        $pelamar->tes_id = null;
        $pelamar->lowongan_id = null;
        $pelamar->file_upload = null;
        if ($pelamar->save()) {
            $nilai = NIlaiAkhirModel::where('pelamar_id', $pelamar->id);
            $nilai->delete();
            alert()->success('Pelamar berhasil ditolak');
            return redirect()->back();
        }
    }

    public function pdf()
    {
        $pelamar = PelamarModel::whereNotNull(['lowongan_id', 'tes_id'])->get();
        $laporan = PelamarModel::whereNotNull(['status_tes'])->get();
        $data = [
            'pelamar' => $pelamar,
            'laporan' => $laporan
        ];

        $filename = 'laporan.pdf';
        $html = view('admin.pdf_laporan', $data)->render();

        $pdf = new TCPDF;
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        // Specify the correct output destination and options
        $pdf::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));

        // return view('admin.pdf_laporan', $data);
    }
}
