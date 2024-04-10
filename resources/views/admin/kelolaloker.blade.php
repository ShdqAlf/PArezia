@extends('components.home', ['title'=>'Dashboard Admin'])

@section('content')
<div class="page-title">
    <h3>Kelola Lowongan Pekerjaan</h3>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="col-auto" style="margin-bottom:30px;">
                        <button class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengguna">Tambah Lowongan</button>
                    </div>
                    <div class="modal fade" id="tambahPengguna" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.kelolaloker.tambah-loker') }}" method="post" enctype="multipart/form-data">>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Judul</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="judul" placeholder="Tambahkan Judul">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Posisi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="posisi" placeholder="Tambahkan Posisi">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Minimal Pendidikan</label>
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
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Minimal pengalaman</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pengalaman" placeholder="Minimal Pengalaman">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Usia Maksimal</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="usia_maks" placeholder="Usia Maksimal">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan Keterangan</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
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
                        <table id="example" class="display" style="width:100%">
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
                                @foreach($lowongan as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->judul }}</td>
                                    <td>{{ $row->posisi }}</td>
                                    <td>{{ $row->minimal_pendidikan }}</td>
                                    <td>{{ $row->minimal_pengalaman }}</td>
                                    <td>{{ $row->usia_maks }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="">Edit</button>
                                        <form action="{{ route('admin.kelolaloker.hapus-loker', $row->id) }}" method="POST" class="d-inline">
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

@endsection