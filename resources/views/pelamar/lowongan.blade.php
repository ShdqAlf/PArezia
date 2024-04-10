@extends('components.home', ['title' => 'Halaman Pelemar'])

@section('content')
    <style>
        .info-a:hover {
            background-color: #5A8DEE;
        }

        .info-a {
            background-color: #A3AFBD;
        }
    </style>
    <div class="page-title">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Lowongan Pekerjaan</h3>
            </div>
            <div class="card-body">
                @foreach ($lowongan as $item)
                    <a href="{{ route('pelamar.test.kemampuan', $item->id) }}" class="">
                        <div class="card mt-3 info-a">
                            <div class="card-body">
                                <div class="info" style="color: #fff">
                                    <h2 class="text-white">{{ $item->judul }}</h2>
                                    <h6 class="text-white">Posisi : {{ $item->posisi }}</h6>
                                    <h6 class="text-white">Pengalaman Terakhir : {{ $item->minimal_pengalaman }}</h6>
                                    <h6 class="text-white">Minimal Pendidikan : {{ $item->minimal_pendidikan }}</h6>
                                    <h6 class="text-white">Batas Usia : {{ $item->usia_maks }} Tahun Maksimal</h6>
                                    <p>{{ $item->keterangan }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
