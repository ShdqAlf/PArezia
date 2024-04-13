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
                            <th>No</th>
                            <th>Lowongan</th>
                            <th>Nilai Tes</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil as $item)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->lowongan->judul }}</td>
                            <td>100</td>
                            <td>
                                @if ($item->status == 0)
                                    <span>Sedang DiProses</span>
                                @else
                                    <span>Sedang DiProses</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batalModal">Batal Tes ?</a>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="batalModal" tabindex="-1" aria-labelledby="batalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batalModalLabel">Pembatalan Tes</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu yakin ingin membatalkan tes kemampuan ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
