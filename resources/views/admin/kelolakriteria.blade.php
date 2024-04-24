@extends('components.home', ['title' => 'Dashboard Admin'])

@section('content')
<div class="page-title">
    <h3>Kelola Kriteria</h3>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="col-auto" style="margin-bottom:30px;">
                        <button class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengguna">Tambah
                            Kriteria</button>
                    </div>
                    <div class="modal fade" id="tambahPengguna" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kriteria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.kelolakriteria.tambah') }}" method="post" enctype="multipart/form-data">>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama
                                                Kriteria</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama_kriteria" placeholder="Tambahkan Kriteria">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Kode Bobot</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="kode_bobot" placeholder="Tambahkan Kode">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nilai Bobot</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nilai_bobot" placeholder="Nilai Bobot">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis
                                                Kriteria</label>
                                            <div class="col-sm-8">
                                                <select class="form-select" id="basicSelect" name="jenis_kriteria">
                                                    <option value="Benefit">Benefit</option>
                                                    <option value="Cost">Cost</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Tambahkan Kriteria</button>
                                    </div>
                                </form><!-- End Horizontal Form -->
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->
                    <div class="table-responsive">
                        <table id="kelolakriteria" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kriteria</th>
                                    <th>Kode Bobot</th>
                                    <th>Nilai Bobot</th>
                                    <th>Jenis Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->nama_kriteria }}</td>
                                    <td>{{ $row->kode_bobot }}</td>
                                    <td>{{ $row->nilai_bobot }}</td>
                                    <td>{{ $row->jenis_kriteria }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id }}">Edit</button>
                                            <!-- <form action="{{ route('admin.kelolakriteria.hapus-kriteria', $row->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form> -->
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $row->id }}">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@foreach ($kriteria as $row)
<div class="modal fade" id="hapusModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus kriteria ini?</b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.kelolakriteria.hapus-kriteria', $row->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-primary">Ya, Hapus Kriteria!</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.kelolakriteria.edit', $row) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Nama Kriteria</label>
                        <input type="text" class="form-control" name="nama_kriteria" value="{{ $row->nama_kriteria }}">
                    </div>
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Kode Bobot</label>
                        <input type="text" class="form-control" name="kode_bobot" value="{{ $row->kode_bobot }}">
                    </div>
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Nilai Bobot</label>
                        <input type="text" class="form-control" name="nilai_bobot" value="{{ $row->nilai_bobot }}">
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Jenis Kriteria</label>
                        <select class="form-select" id="role" name="jenis_kriteria">
                            <option value="Benefit" {{ $row->jenis_kriteria == 'Benefit' ? 'selected' : '' }}>
                                Benefit</option>
                            <option value="Cost" {{ $row->jenis_kriteria == 'Cost' ? 'selected' : '' }}>Cost
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#kelolakriteria');
</script>
@endsection