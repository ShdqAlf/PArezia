@extends('components.home', ['title' => 'Laporan'])

@section('content')
    <div class="page-title">
        <h3>Laporan</h3>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-4">
                            <form action="{{ route('pimpinan.dashboard') }}" method="GET">
                                <div class="mb-3">
                                    <label for="filter" class="form-label">Filter Lowongan</label>
                                    <div class="input-group">
                                        <select name="filter" id="filter" onchange="this.form.submit()"
                                            class="form-select">
                                            @if ($laporanfilter !== null && !$laporanfilter->isEmpty())
                                                @foreach ($laporanfilter as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($pilih_lowongan == $item->judul) selected @endif>
                                                        {{ $item->judul }}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled selected>Periode belum ada</option>
                                            @endif
                                        </select>
                                        <button class="btn btn-primary" type="submit">
                                            <i data-feather="search" width="20"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="text-right">
                            <a href="" class="btn btn-primary">
                                <i data-feather="printer" width="20"></i>
                                Cetak Laporan
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table id="laporantes" class="table display " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelamar</th>
                                        <th>Nama Lowongan</th>
                                        <th>Nilai Qi</th>
                                        <th>Ranking</th>
                                        <th>Status Penerimaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pilih_lowongan)
                                        @foreach ($laporan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->lowongan->judul ?? 'Pelamar sudah ditolak' }}</td>
                                                <td>{{ $item->nilaiakhir->nilaiqi ?? 'Pelamar sudah ditolak' }}</td>
                                                <td>{{ $item->nilaiakhir->rangking ?? 'Pelamar sudah ditolak' }}</td>
                                                <td class="text-white">
                                                    @if ($item->status_tes == 'Diterima')
                                                        <span
                                                            class="bg-success rounded text-white p-2 mt-3 mb-3">{{ $item->status_tes }}</span>
                                                    @elseif($item->status_tes == 'Ditolak')
                                                        <span
                                                            class="bg-danger rounded text-white p-2 mt-3 mb-3">{{ $item->status_tes }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#laporantes');
    </script>
@endsection
