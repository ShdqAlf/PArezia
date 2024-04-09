@extends('components.auth.home', ['title' => 'Pendaftaran Pelamar'])

@section('content')
    <div class="text-center mb-5">
        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
        <h3>Pendaftaran</h3>
        <p>Silahkan untuk melakukan pendaftaran terlebih dulu</p>
        @if ($errors->any())
            <div class="alert alert-danger text-start">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form action="{{ route('proses.pendaftaran') }}" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left">
            <label for="nama">Nama Lengkap</label>
            <div class="position-relative">
                <input type="name" class="form-control" id="nama" name="nama">
                <div class="form-control-icon">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group position-relative has-icon-left">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                        <div class="form-control-icon">
                            <i data-feather="map-pin"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group position-relative has-icon-left">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <div class="position-relative">
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                        <div class="form-control-icon">
                            <i data-feather="calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left">
            <label for="email">Email</label>
            <div class="position-relative">
                <input type="email" class="form-control" id="email" name="email">
                <div class="form-control-icon">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left">
            <label for="no_hp">No WhatsApp</label>
            <div class="position-relative">
                <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="[0-9]*">
                <div class="form-control-icon">
                    <i data-feather="phone"></i>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <label for="floatingTextarea2">Alamat Lengkap</label>
            <div class="position-relative">
                <textarea class="form-control" name="alamat" placeholder="Masukkan alamat disini" id="floatingTextarea2"
                    style="height: 100px"></textarea>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left">
            <div class="clearfix">
                <label for="password">Password</label>
            </div>
            <div class="position-relative">
                <input type="password" class="form-control" id="password" name="password">
                <div class="form-control-icon">
                    <i data-feather="lock"></i>
                </div>
            </div>
        </div>
        <div class="clearfix mt-3">
            <button class="btn btn-primary float-right" type="submit">Daftar</button>
        </div>
        <div class="text-center">
            <p>Sudah memiliki akun?</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login Sekarang!</a>
        </div>
    </form>
@endsection
