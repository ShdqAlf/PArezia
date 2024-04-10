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
                @foreach ($lowongans as $item)
                    @php
                        $testExists = $item->teskemampuan()->exists();
                    @endphp
                    <a href="{{ $testExists ? route('pelamar.test.kemampuan', $item->id) : '#' }}"
                        class="{{ $testExists ? '' : 'disabled' }}" onclick="{{ $testExists ? '' : 'showSweetAlert(); return false;' }}">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function showSweetAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Test Kemampuan Tidak Tersedia',
                text: 'Maaf, test kemampuan untuk lowongan ini belum tersedia.',
            });
        }
    </script>

@endsection
