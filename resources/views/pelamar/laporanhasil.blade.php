@extends('components.home', ['title' => 'Laporan Hasil - Pelamar'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="page-title">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Laporan Hasil Lowongan</h3>
            </div>
            <div class="card-body mt-4">
                <table id="example" class="table table-responsive table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Nama</th>
                            <th>Lowongan</th>
                            <th>Nilai</th>
                            <th>Ranking</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelamar as $item)
                        <tr>
                        <td>{{ $item->nama }}</td>
                            <td>
                                @if ($item->status_tes == null)
                                    {{ $item->lowongan->judul }}
                                @elseif($item->status_tes == 'Ditolak')
                                    <span>Kamu Tidak Diterima</span>
                                @elseif($item->status_tes == 'Diterima')
                                    {{ $item->lowongan->judul }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status_tes == null)
                                    <span>Sedang Dinilai</span>
                                @elseif($item->status_tes == 'Ditolak')
                                    <span>Kamu Tidak Diterima</span>
                                @elseif($item->status_tes == 'Diterima')
                                    {{ $item->nilaiakhir->nilaiqi ?? '0' }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status_tes == null)
                                    <span>Belum ada ranking</span>
                                @elseif($item->status_tes == 'Ditolak')
                                    <span>Kamu Tidak Diterima</span>
                                @elseif($item->status_tes == 'Diterima')
                                    {{ $item->nilaiakhir->rangking ?? '0' }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->status_tes == null)
                                    <span class="bg-secondary rounded text-white p-2">Sedang DiProses</span>
                                @elseif($item->status_tes == 'Diterima')
                                    <span class="bg-success rounded text-white p-2">Selamat Anda Diterima</span>
                                @elseif($item->status_tes == 'Ditolak')
                                    <span class="bg-danger rounded text-white p-2">Maaf Anda Tidak Diterima</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
