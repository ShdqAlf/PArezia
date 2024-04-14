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
                    <h3 class="text-white">Perkalian Nilai Bobot</h3>
                </div>
                <div class="card-body">
                    <table id="perkalian" class="table table-responsive table-bordered" style="width:100%">
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
                                @foreach ($penilaian->unique('kriteria_id') as $nilai)
                                <td>{{ isset($multipliedValues[$item->pelamar_id][$nilai->kriteria_id]) ? $multipliedValues[$item->pelamar_id][$nilai->kriteria_id] : '' }}</td>
                                @endforeach
                                <td>{{ isset($summedValues[$item->pelamar_id]) ? $summedValues[$item->pelamar_id] : '' }}</td>
                                <td>{{ isset($multipliedByHalf[$item->pelamar_id]) ? $multipliedByHalf[$item->pelamar_id] : '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Pemangkatan nilai Bobot</h3>
                </div>
                <div class="card-body">
                    <table id="pemangkatan" class="table table-responsive table-bordered" style="width:100%">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th>Nama Pelamar</th>
                                @foreach ($penilaian->unique('kriteria_id') as $item)
                                <th>{{ $item->kriteria->kode_bobot }}</th>
                                @endforeach
                                <th>CROSS</th>
                                <th>CROSS * 0.5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian->unique('pelamar_id') as $item)
                            <tr>
                                <td>{{ $item->pelamar->nama }}</td>
                                @foreach ($penilaian->unique('kriteria_id') as $nilai)
                                <td>{{ isset($poweredValues[$item->pelamar_id][$nilai->kriteria_id]) ? $poweredValues[$item->pelamar_id][$nilai->kriteria_id] : '' }}</td>
                                @endforeach
                                <td>{{ isset($crossValues[$item->pelamar_id]) ? $crossValues[$item->pelamar_id] : '' }}</td>
                                <td>{{ isset($multipliedCrossByHalf[$item->pelamar_id]) ? $multipliedCrossByHalf[$item->pelamar_id] : '' }}</td>
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
                                <th>Nama Pelamar</th>
                                <th>Nilai QI</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian->unique('pelamar_id') as $item)
                            <tr>
                                <td>{{ $item->pelamar->nama }}</td>
                                <td>{{ $qiValues[$item->pelamar_id] }}</td>
                                <td>{{ $ranking[$item->pelamar_id] }}</td>
                            </tr>
                            @endforeach
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
    new DataTable('#perkalian');
    new DataTable('#pemangkatan');
    new DataTable('#normalisasi');
    new DataTable('#perhitungan');
</script>
@endsection