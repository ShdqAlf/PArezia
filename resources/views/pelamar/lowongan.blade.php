@extends('components.home', ['title' => 'Halaman Pelemar'])

@section('content')
    <style>
        .info-a:hover {
            background-color: #A3AFBD;
        }

        .info-a {
            background-color: #FDAC41;
            padding: 10px;
            border-radius: 10px;
        }

        .info-a-tes {
            background-color: #39DA8A;
            padding: 10px;
            border-radius: 10px;
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

                    <div class="card mt-3 bg-primary">
                        <div class="card-body">
                            <div class="info" style="color: #fff">
                                <h2 class="text-white">{{ $item->judul }}</h2>
                                <h6 class="text-white">Posisi : {{ $item->posisi }}</h6>
                                <h6 class="text-white">Pengalaman Terakhir : {{ $item->minimal_pengalaman }}</h6>
                                <h6 class="text-white">Minimal Pendidikan : {{ $item->minimal_pendidikan }}</h6>
                                <h6 class="text-white">Batas Usia : {{ $item->usia_maks }} Tahun Maksimal</h6>
                                <p>{{ $item->keterangan }}</p>
                            </div>
                            <div class="text-end">
                                @if ($testExists)
                                    @if ($item->teskemampuan->file_upload == null)
                                        <a href="{{ $testExists ? route('pelamar.test.kemampuan', $item->id) : '#' }}"
                                            class="{{ $testExists ? '' : 'disabled' }} info-a text-white"
                                            onclick="{{ $testExists ? '' : 'showSweetAlert(); return false;' }}">Ikuti Tes
                                            Kemampuan
                                        </a>
                                    @else
                                        <a class="info-a-tes text-white">Tes Sudah Selesai</a>
                                    @endif
                                @else
                                    <a href="{{ $testExists ? route('pelamar.test.kemampuan', $item->id) : '#' }}"
                                        class="{{ $testExists ? '' : 'disabled' }} info-a text-white"
                                        onclick="{{ $testExists ? '' : 'showSweetAlert(); return false;' }}">Ikuti Tes
                                        Kemampuan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
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
