@extends('components.home', ['title' => 'Dashboard Admin'])

@section('content')
<div class="page-title">
    <h3>Kelola Lowongan Pekerjaan</h3>
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
                            Lowongan</button>
                    </div>
                    <div class="modal fade" id="tambahPengguna" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Lowongan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.kelolaloker.tambah-loker') }}" method="post" enctype="multipart/form-data">>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Judul</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="judul" placeholder="Tambahkan Judul" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Posisi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="posisi" placeholder="Tambahkan Posisi" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Minimal
                                                Pendidikan</label>
                                            <div class="col-sm-8">
                                                <select class="form-select" id="basicSelect" name="pendidikan">
                                                    <option selected>Pilih Minimal Pendidikan</option>
                                                    <option value="SD/Sederajat">SD/Sederajat</option>
                                                    <option value="SMP/Sederajat">SMP</option>
                                                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                                                    <option value="D3">D3</option>
                                                    <option value="S1/D4">S1/D4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Minimal
                                                pengalaman</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pengalaman" placeholder="Minimal Pengalaman" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Usia
                                                Maksimal</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" name="usia_maks" placeholder="Usia Maksimal" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal
                                                Berakhir</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="tanggal_berakhir" placeholder="Tanggal Berakhir" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan
                                                Keterangan</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Tambahkan Lowongan</button>
                                    </div>
                                </form><!-- End Horizontal Form -->
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->
                    <div class="table-responsive">
                        <table id="kelolaloker" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Posisi</th>
                                    <th>Minimal Pendidikan</th>
                                    <th>Minimal Pengalaman</th>
                                    <th>Usia Maksimal</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lowongan as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->judul }}</td>
                                    <td>{{ $row->posisi }}</td>
                                    <td>{{ $row->minimal_pendidikan }}</td>
                                    <td>{{ $row->minimal_pengalaman }}</td>
                                    <td>{{ $row->usia_maks }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id }}">Edit</button>
                                            <!-- <form action="{{ route('admin.kelolaloker.hapus-loker', $row->id) }}" method="POST" class="d-inline">
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
    </div>
</section>
@foreach ($lowongan as $row)
<div class="modal fade" id="hapusModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Lowongan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus lowongan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.kelolaloker.hapus-loker', $row->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-primary">Ya, Hapus Pengguna!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Lowongan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.kelolaloker.edit', $row) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" value="{{ $row->judul }}">
                    </div>
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi" value="{{ $row->posisi }}">
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Minimal Pendidikan</label>
                        <select class="form-select" id="role" name="pendidikan">
                            <option value="SD/Sederajat" {{ $row->minimal_pendidikan == 'SD/Sederajat' ? 'selected' : '' }}>SD/Sederajat
                            </option>
                            <option value="SMP/Sederajat" {{ $row->minimal_pendidikan == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat
                            </option>
                            <option value="SMA/Sederajat" {{ $row->minimal_pendidikan == 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat
                            </option>
                            <option value="D3" {{ $row->minimal_pendidikan == 'D3' ? 'selected' : '' }}>D3
                            </option>
                            <option value="S1/D4" {{ $row->minimal_pendidikan == 'S1/D4' ? 'selected' : '' }}>
                                S1/D4</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pengalaman" class="form-label">Minimal Pengalaman</label>
                        <input type="text" class="form-control" name="pengalaman" value="{{ $row->minimal_pengalaman }}">
                    </div>
                    <div class="mb-3">
                        <label for="usia_maks" class="form-label">Usia Maksimal</label>
                        <input type="text" class="form-control" name="usia_maks" value="{{ $row->usia_maks }}">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" value="{{ $row->keterangan }}">
                    </div>
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
    new DataTable('#kelolaloker');
</script>
@endsection