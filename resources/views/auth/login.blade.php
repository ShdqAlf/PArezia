@extends('components.auth.home', ['title'=>'Login'])

@section('content')
    <div class="text-center mb-5">
        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
        <h3>Login</h3>
        <p>Login untuk melanjutkan</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form action="{{ route('post.login') }}" method="POST">
        @csrf
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
        <div class="clearfix">
            <button class="btn btn-primary float-right" type="submit">Login</button>
        </div>
        <div class="text-center">
            <p>Belum memiliki akun?</p>
            <a href="{{ route('pendaftaran') }}" class="btn btn-primary">Daftar Sekarang!</a>
        </div>
    </form>
@endsection
