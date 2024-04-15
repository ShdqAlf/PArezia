@extends('components.home', ['title' => 'Laporan Hasil = Pelamar'])

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
                            <th>Lowongan</th>
                            <th>Nilai</th>
                            <th>Ranking</th>
                            <th>Status</th>
                            @if ($pelamar != null && $pelamar->isBatal === 0)
                                @if ($pelamar->status_tes == null)
                                    <th>Aksi</th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pelamar != null && $pelamar->isBatal === 0)
                            <td>
                                @if ($pelamar->status_tes == null)
                                    {{ $pelamar->lowongan->judul }}
                                @elseif($pelamar->status_tes == 'Ditolak')
                                    <span>Kamu Tidak Diterima</span>
                                @elseif($pelamar->status_tes == 'Diterima')
                                    {{ $pelamar->lowongan->judul }}
                                @endif
                            </td>
                            <td>
                                @if ($pelamar->status_tes == null)
                                    <span>Sedang Dinilai</span>
                                @elseif($pelamar->status_tes == 'Ditolak')
                                    <span>Kamu Tidak Diterima</span>
                                @elseif($pelamar->status_tes == 'Diterima')
                                    {{ $pelamar->nilaiakhir->nilaiqi ?? '0' }}
                                @endif
                            </td>
                            <td>
                                @if ($pelamar->status_tes == null)
                                    <span>Belum ada ranking</span>
                                @elseif($pelamar->status_tes == 'Ditolak')
                                    <span>Kamu Tidak Diterima</span>
                                @elseif($pelamar->status_tes == 'Diterima')
                                    {{ $pelamar->nilaiakhir->rangking ?? '0' }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($pelamar->status_tes == null)
                                    <span class="bg-secondary rounded text-white p-2">Sedang DiProses</span>
                                @elseif($pelamar->status_tes == 'Diterima')
                                    <span class="bg-success rounded text-white p-2">Selamat Anda Diterima</span>
                                @elseif($pelamar->status_tes == 'Ditolak')
                                    <span class="bg-danger rounded text-white p-2">Maaf Anda Tidak Diterima</span>
                                @endif
                            </td>
                            @if ($pelamar->status_tes == null)
                                <td>
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batalModal">Batal Tes
                                        ?</a>
                                </td>
                            @else
                                {{ null }}
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @if ($pelamar != null && $pelamar->isBatal === 0)
        <div class="modal fade" id="batalModal" tabindex="-1" aria-labelledby="batalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batalModalLabel">Pembatalan Tes</h5>
                    </div>
                    <form action="{{ route('pelamar.batal.tes', $pelamar->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <p>Apakah kamu yakin ingin membatalkan tes kemampuan ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
