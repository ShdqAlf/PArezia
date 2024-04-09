@extends('components.home', ['title'=>'Dashboard Admin'])

@section('content')
<div class="page-title">
    <h3>Kelola Tes Kemampuan</h3>
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
                        <button class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengguna">Tambah Pengguna</button>
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
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan Sebuah Pertanyaan</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="pertanyaan"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan Sebuah Foto</label>
                                            <div class="form-file">
                                                <input type="file" class="form-file-input" id="customFile" name="foto">
                                                <label class="form-file-label" for="customFile">
                                                    <span class="form-file-text">Pilih Foto...</span>
                                                    <span class="form-file-button btn-primary "><i data-feather="upload"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Tambahkan Sebuah File</label>
                                            <div class="form-file">
                                                <input type="file" class="form-file-input" id="customFile" name="file">
                                                <label class="form-file-label" for="customFile">
                                                    <span class="form-file-text">Pilih file...</span>
                                                    <span class="form-file-button btn-primary "><i data-feather="upload"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Tambahkan Pengguna</button>
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
                                    <th>pertanyaan</th>
                                    <th>Foto</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tesKemampuan as $key => $tes)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tes->pertanyaan }}</td>
                                    <td><img src="{{ asset($tes->foto) }}" alt="Foto" style="width:200px"></td>
                                    <td><a href="{{ asset($tes->file) }}" download>Unduh File</a></td>

                                    <td>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $tes->id }}">Edit</button>
                                        <form action="{{ route('admin.kelolates.hapus-tes', $tes->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
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