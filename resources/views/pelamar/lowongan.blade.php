@extends('components.home', ['title' => 'Lowongan - Pelamar'])

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

        .info-a-tes-id {
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
                @php
                    $user = Auth::user();
                @endphp

                @foreach ($lowongans as $item)
                    @php
                        $testExists = $item->teskemampuan()->exists();
                        $pelamar = $user
                            ->pelamar()
                            ->where('lowongan_id', $item->id)
                            ->first();
                        $pelamarv = $user->pelamar()->first();
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
                                    @if ($pelamar)
                                        @if ($pelamarv->status_tes == 'Diterima' || $pelamarv->status_tes != null)
                                            <a href="{{ route('pelamar.syarat', $item->id) }}"
                                                class="info-a text-white">Ikuti Tes Kemampuan</a>
                                        @else
                                            @if ($pelamarv->tes_id != null)
                                                @if ($pelamarv->file_upload != null)
                                                    <a class="info-a-tes text-white">Tes Sudah Selesai</a>
                                                    @if ($pelamarv->status_tes == null)
                                                        <td>
                                                            <a class="btn btn-danger" data-bs-toggle="modal"
                                                                data-bs-target="#batalModal">Batal Tes
                                                                ?</a>
                                                        </td>
                                                    @endif
                                                @else
                                                    <a href="#" onclick="existsTes()" class="info-a text-white">Ikuti
                                                        Tes
                                                        Kemampuan</a>
                                                @endif
                                            @elseif($pelamarv->syarat_id != null)
                                                <a href="{{ route('pelamar.test.kemampuan', $item->syarat()->id) }}"
                                                    class="info-a text-white">Ikuti Tes Kemampuan</a>
                                            @else
                                                <a href="{{ route('pelamar.syarat', $item->id) }}"
                                                    class="info-a text-white">Ikuti Tes Kemampuan</a>
                                            @endif
                                        @endif
                                    @else
                                        @if ($pelamarv->status_tes == 'Diterima' || $pelamarv->status_tes != null)
                                            <a href="{{ route('pelamar.syarat', $item->id) }}"
                                                class="info-a text-white">Ikuti Tes Kemampuan</a>
                                        @else
                                            @if ($pelamarv->lowongan_id == null)
                                                <a href="{{ route('pelamar.syarat', $item->id) }}"
                                                    class="info-a text-white">Ikuti Tes Kemampuan</a>
                                            @else
                                                <a href="#" onclick="existsTes()" class="info-a text-white">Ikuti Tes
                                                    Kemampuan</a>
                                            @endif
                                        @endif
                                    @endif
                                @else
                                    <a href="#" onclick="showSweetAlert()" class="info-a text-white">Ikuti Tes
                                        Kemampuan</a>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <div class="modal fade" id="batalModal" tabindex="-1" aria-labelledby="batalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batalModalLabel">Pembatalan Tes</h5>
                </div>
                <form action="{{ route('pelamar.batal.tes', $pelamarv->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <p>Apakah kamu yakin ingin membatalkan tes kemampuan ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function showSweetAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Test Kemampuan Tidak Tersedia',
                text: 'Maaf, test kemampuan untuk lowongan ini belum tersedia.',
            });
        }

        function existsTes() {
            Swal.fire({
                icon: 'warning',
                title: 'Tes Sudah Ada',
                text: 'Maaf, kamu sudah mengikuti tes sebelumnya harap menunggu hasil.',
            });
        }
    </script>
@endsection
