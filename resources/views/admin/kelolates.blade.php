@extends('components.home', ['title' => 'Dashboard Admin'])

@section('content')
<div class="page-title">
    <h3>Kelola Tes Kemampuan</h3>
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
                            Tes</button>
                    </div>
                    <div class="modal fade" id="tambahPengguna" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.kelolates.tambah-tes') }}" method="post" enctype="multipart/form-data">>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan
                                                Keterangan</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan File
                                                atau URL</label>
                                            <select class="form-select" id="customFileOrUrl" name="customFileOrUrl">
                                                <option disabled selected>Pilih...</option>
                                                <option value="file">File</option>
                                                <option value="url">URL</option>
                                            </select>
                                        </div>
                                        <div id="fileInputContainer" style="display: none;" class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan
                                                File</label>
                                            <div class="form-file">
                                                <input type="file" class="form-control" id="customFile" name="file">
                                            </div>
                                        </div>
                                        <div id="urlInputContainer" style="display: none;" class="form-group mb-3">
                                            <label for="urlInput" class="form-label">Masukkan URL</label>
                                            <input type="text" class="form-control" id="urlInput" name="url">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tambahkan
                                                Judul</label>
                                            <select class="form-select" id="basicSelect" name="judul">
                                                <option selected>Pilih Judul</option>
                                                @foreach ($loker as $key => $tes)
                                                <option value="{{ $tes->id }}">{{ $tes->judul }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Tambahkan Tes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->
                    <div class="table-responsive">
                        <table id="kelolates" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Lowongan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tesKemampuan as $key => $tes)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tes->keterangan }}</td>
                                    <td>
                                        @if ($tes->file_download != null)
                                        <a href="{{ asset($tes->file) }}" download>Unduh File</a>
                                        @else
                                        <a href="{{ $tes->url }}" target="_blank">{{ $tes->url }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $tes->lowongan->judul }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $tes->id }}">Edit</button>
                                        <!-- <form action="{{ route('admin.kelolates.hapus-tes', $tes->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form> -->
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $tes->id }}">Hapus</button>
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
@foreach ($tesKemampuan as $tes)
<div class="modal fade" id="hapusModal{{ $tes->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Tes Kemampuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus tes kemampuan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.kelolates.hapus-tes', $tes->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-primary">Ya, Hapus Pengguna!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal{{ $tes->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tes Kemampuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.kelolates.edit', $tes) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" value="{{ $tes->keterangan }}">
                    </div>
                    @if ($tes->url != null)
                    <div id="urlInputContainer" class="form-group mb-3">
                        <label for="urlInput" class="form-label">Masukkan URL</label>
                        <input type="text" class="form-control" id="urlInput" name="url" value="{{ $tes->url }}">
                    </div>
                    @else
                    <div id="fileInputContainer" class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Tambahkan
                            File</label>
                        <div class="form-file">
                            <input type="file" class="form-control" id="customFile" name="file">
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Judul</label>
                        <select class="form-select" id="role" name="judul">
                            <option>Pilih Judul</option>
                            @foreach ($loker as $key => $judul)
                            <option value="{{ $judul->id }}" {{ $tes->loker_id == $judul->id ? 'selected' : '' }}>{{ $judul->judul }}
                            </option>
                            @endforeach
                        </select>
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
    new DataTable('#kelolates');
</script>
<script>
    $('#customFileOrUrl').change(function() {
        var selectedOption = $(this).val();
        if (selectedOption === 'file') {
            $('#fileInputContainer').show();
            $('#urlInputContainer').hide();
        } else if (selectedOption === 'url') {
            $('#urlInputContainer').show();
            $('#fileInputContainer').hide();
        }
    });
</script>
@endsection