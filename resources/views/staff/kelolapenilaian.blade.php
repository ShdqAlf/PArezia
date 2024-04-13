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
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3 class="text-white"></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#kelola_penilaian');
    </script>

    @foreach ($teskemampuan as $tes)
        <div class="modal fade" id="tambahModal{{ $tes->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('staff.kelolapenilaian.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $tes->id }}" name="teskemampuan_id">
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
@endsection
