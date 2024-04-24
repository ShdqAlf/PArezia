@extends('components.home', ['title' => 'Profil - Pelamar'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="card-title">Profil</h4>
                <form action="{{ route('pelamar.edit.profil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-4">
                            @if ($pelamar->foto_profil == null)
                                <img src="https://cdn.idntimes.com/content-images/post/20240207/33bac083ba44f180c1435fc41975bf36-ca73ec342155d955387493c4eb78c8bb.jpg"
                                    class="border rounded" alt="Profil Picture" width="200" id="previewImage">
                            @else
                                <img src="{{ asset($pelamar->foto_profil) }}" class="border rounded" alt="Profil Picture"
                                    width="200" id="previewImage">
                            @endif
                            <div class="mt-3" style="margin-left: 70px">
                                <div class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-0" for="customFile1">
                                        <i data-feather="camera"></i>
                                    </label>
                                    <input type="file" class="form-control d-none" id="customFile1" name="foto_profil"
                                        onchange="previewFile()">
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                        <input type="name" name="nama" class="form-control"
                                            value="{{ $pelamar->nama }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nomor HP</label>
                                        <input type="text" name="no_hp" class="form-control"
                                            value="{{ $pelamar->no_hp ?? '' }}" pattern="[0-9]+"
                                            title="Masukkan hanya nomor">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control"
                                                value="{{ $pelamar->tempat_lahir ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                value="{{ $pelamar->tanggal_lahir ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Masukkan alamat disini" name="alamat" id="floatingTextarea2"
                                            style="height: 100px">{{ $pelamar->alamat ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function previewFile() {
            var input = document.getElementById('customFile1');
            var preview = document.getElementById('previewImage');

            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
