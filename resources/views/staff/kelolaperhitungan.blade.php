@extends('components.home', ['title' => 'Kelola Perhitungan'])

@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header bg-secondary">
            <h3 class="text-white">Kelola Perhitungan</h3>
        </div>
        <div class="card-body mt-4">
            <div class="card mb-5">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Normalisasi</h3>
                </div>
                <div class="card-body">
                    <table id="normalisasi" class="table table-responsive table-bordered" style="width:100%">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th>Nama Pelamar</th>
                                @foreach ($penilaian->unique('kriteria_id') as $item)
                                <th>{{ $item->kriteria->kode_bobot }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th>Jenis Kriteria</th>
                                @foreach ($kriteria as $item)
                                <th>{{ $item->jenis_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian->unique('pelamar_id') as $item)
                            <tr>
                                <td>{{ $item->pelamar->nama }}</td>
                                @foreach ($penilaian->where('pelamar_id', $item->pelamar_id) as $nilai)
                                <td>{{ $nilai->perhitungan }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nilai Bobot</th>
                                @foreach ($kriteria as $item)
                                <th>{{ $item->nilai_bobot }}</th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Nilai QI</h3>
                </div>
                <div class="card-body">
                    <table id="nilai_qi" class="table table-responsive table-bordered" style="width:100%">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th>Nama Pelamar</th>
                                @foreach ($penilaian->unique('kriteria_id') as $item)
                                <th>{{ $item->kriteria->kode_bobot }}</th>
                                @endforeach
                                <th>SUM</th>
                                <th>SUM * 0.5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian->unique('pelamar_id') as $item)
                            <tr>
                                <td>{{ $item->pelamar->nama }}</td>
                                @php
                                $totalNilai = 0;
                                @endphp
                                @foreach ($penilaian->where('pelamar_id', $item->pelamar_id) as $nilai)
                                <td>{{ $nilai->nilai_bobot }}</td>
                                @php
                                $totalNilai += $nilai->nilai_bobot;
                                @endphp
                                @endforeach
                                <td>{{ $totalNilai }}</td>
                                <td>{{ $totalNilai * 0.5 }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Perkalian</h3>
                </div>
                <div class="card-body">
                    <table id="kali" class="table table-responsive table-bordered" style="width:100%">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th>Nama Pelamar</th>
                                @foreach ($penilaian->unique('kriteria_id') as $item)
                                <th>{{ $item->kriteria->kode_bobot }}</th>
                                @endforeach
                                <th>Perkalian</th>
                                <th>Perkalian * 0.5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian->unique('pelamar_id') as $item)
                            <tr>
                                <td>{{ $item->pelamar->nama }}</td>
                                @php
                                $hasilPerhitungan = [];
                                $hasilPerkalian = 1;
                                @endphp
                                @foreach ($penilaian->where('pelamar_id', $item->pelamar_id) as $nilai)
                                <td>{{ $nilai->nilai_bobot }}</td>
                                @php
                                $hasilPerkalian *= $nilai->nilai_bobot;
                                @endphp
                                @endforeach
                                <td>{{ $hasilPerkalian }}</td>
                                <td>{{ $hasilPerkalian * 0.5 }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Perhitungan</h3>
                </div>
                <div class="card-body">
                    <table id="perhitungan" class="table table-responsive table-bordered" style="width:100%">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th>Nilai QI</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalQI = 0;
                            @endphp
                            @foreach ($sum as $pelamarId => $totalNilai)
                            <tr>
                                <td>{{ $totalNilai * 0.5 }}</td>
                                <td></td>
                            </tr>
                            @php
                            $totalQI += ($totalNilai * 0.5);
                            @endphp
                            @endforeach
                            <!-- Tambahkan baris untuk total QI di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#nilai_qi');
    new DataTable('#normalisasi');
    new DataTable('#perhitungan');
</script>
@endsection