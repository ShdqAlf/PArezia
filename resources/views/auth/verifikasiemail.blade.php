@extends('components.auth.home', ['title' => 'Verifikasi Email'])

@section('content')
    <div class="text-center mb-5">
        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
        <h3>Verifikasi Email</h3>
        <p>Silahkan untuk melakukan verifikasi email melalui gmail anda.</p>
    </div>
    <div class="text-center">
        <p>Tidak ada pesan email?</p>
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
                Kirim Ulang Verifikasi Email
            </button>
        </form>
        <a href="{{ route('logout') }}">Kembali ke login?</a>
    </div>
@endsection
