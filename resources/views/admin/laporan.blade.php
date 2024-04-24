@extends('components.home', ['title' => 'Dashboard Admin'])

@section('content')
    <div class="page-title">
        <h3>Laporan</h3>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h2 class="text-white">Hasil Tes Pelamar</h2>
                            </div>
                            <div class="card-body mt-3">
                                <div class="mt-4">
                                    <form action="{{ route('admin.laporan') }}" method="GET">
                                        <div class="mb-3">
                                            <label for="filter" class="form-label">Filter Lowongan</label>
                                            <div class="input-group">
                                                <select name="filter" id="filter" onchange="this.form.submit()"
                                                    class="form-select">
                                                    @if ($filterlow !== null && !$filterlow->isEmpty())
                                                        @foreach ($filterlow as $item)
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
                                <div class="table-responsive">
                                    <table id="hasiltes" class="table display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Pelamar</th>
                                                <th>Nama Lowongan</th>
                                                <th>Nilai Qi</th>
                                                <th>Ranking</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($pilih_lowongan)
                                                @foreach ($pelamar as $item)
                                                    <tr>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->lowongan->judul ?? 'Belum melakukan tes' }}</td>
                                                        <td>{{ $item->nilaiakhir->nilaiqi ?? 'Sedang dinilai' }}</td>
                                                        <td>{{ $item->nilaiakhir->rangking ?? 'Belum ada ranking' }}</td>
                                                        <td class="text-center">
                                                            @if ($item->status_tes == null)
                                                                <a class="btn btn-success mt-2 mb-2" data-bs-toggle="modal"
                                                                    data-bs-target="#diterimaModal{{ $item->id }}">
                                                                    <i data-feather="check-circle" width="20"></i>
                                                                </a>
                                                                <a href="" class="btn btn-danger mt-2 mb-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#ditolakModal{{ $item->id }}">
                                                                    <i data-feather="x-circle" width="20"></i>
                                                                </a>
                                                            @else
                                                                @if ($item->status_tes == 'Diterima')
                                                                    <span
                                                                        class="bg-success rounded text-white p-2 mt-3 mb-3">{{ $item->status_tes }}</span>
                                                                @elseif($item->status_tes == 'Ditolak')
                                                                    <span
                                                                        class="bg-danger rounded text-white p-2 mt-3 mb-3">{{ $item->status_tes }}</span>
                                                                @endif
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

                        <div class="card mt-5">
                            <div class="card-header bg-light">
                                <h2 class="text-white">Laporan Tes Pelamar</h2>
                            </div>
                            <div class="card-body mt-5">
                                <div class="text-right">
                                    <a href="" class="btn btn-primary">
                                        <i data-feather="printer" width="20"></i>
                                        Print
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    @if ($pilih_lowongan)
    @foreach ($pelamar as $item)
    <div class="modal fade" id="diterimaModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Penerimaan Pelamar</h5>
                </div>
                <form action="{{ route('admin.pelamar.diterima', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menerima pelamar ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Diterima</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


@foreach ($pelamar as $item)
    <div class="modal fade" id="ditolakModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Penerimaan Pelamar</h5>
                </div>
                <form action="{{ route('admin.pelamar.ditolak', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menolak pelamar ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Ditolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
    @endif



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#hasiltes');
        new DataTable('#laporantes');
    </script>
@endsection
