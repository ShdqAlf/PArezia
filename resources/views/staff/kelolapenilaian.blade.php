@extends('components.home', ['title' => 'Halaman Staff'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="text-white">Kelola Penilaian</h3>
            </div>
            <div class="card-body mt-4">
                <div class="card mb-5">
                    <div class="card-header bg-secondary">
                        <h3 class="text-white">Input Penilaian Pelamar</h3>
                    </div>
                    <div class="card-body mt-3">
                        <table id="penilaian_pelamar" class="table table-responsive table-bordered" style="width:100%">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th>No</th>
                                    <th>Nama Pelamar</th>
                                    <th>Judul Lowongan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelamar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->lowongan->judul }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#tambahModal{{ $item->id }}">
                                                <i data-feather="plus" width="20"></i>
                                                Input
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body mt-4">
                <div class="card mb-5">
                    <div class="card-header bg-secondary">
                        <h3 class="text-white">Hasil Penilaian Pelamar</h3>
                    </div>
                    <div class="card-body mt-3">
                        <table id="hasil_penilaian_pelamar" class="table table-responsive table-bordered" style="width:100%">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th>Nama Pelamar</th>
                                    @foreach ($penilaian->unique('kriteria_id') as $item)
                                        <th>{{ $item->kriteria->kode_bobot }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penilaian->unique('pelamar_id') as $item)
                                    <tr>
                                        <td>{{ $item->pelamar->nama }}</td>
                                        @foreach ($penilaian->where('pelamar_id', $item->pelamar_id) as $nilai)
                                            <td>{{ $nilai->nilai }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>





    @foreach ($pelamar as $item)
        <div class="modal fade" id="tambahModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('staff.kelolapenilaian.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pelamar_id" value="{{ $item->id }}">
                        <div class="modal-body">
                            @foreach ($kriteria as $row)
                                <div class="mb-3">
                                    <label for="" class="form-label">Nilai {{ $row->kode_bobot }}</label>
                                    <input type="number" class="form-control" id="email"
                                        name="nilai_{{ $row->id }}"
                                        placeholder="Masukkan Nilai {{ $row->kode_bobot }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah Nilai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#penilaian_pelamar');
        new DataTable('#hasil_penilaian_pelamar');
    </script>
@endsection
