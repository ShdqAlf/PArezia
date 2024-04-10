@extends('components.home', ['title' => 'Halaman Pelemar'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Tes Kemampuan</h3>
                <p class="text-white">Berakhir Pada Tanggal :
                    {{ \Carbon\Carbon::parse($tes->lowongan->tanggal_berakhir)->locale('id_ID')->isoFormat('D MMMM Y') }}
                </p>
                <a href="{{ route('pelamar.dashboard') }}" class="btn btn-secondary text-white">
                   <div class="d-flex align-items-center">
                    <i data-feather="chevron-left" width="20"></i>
                    Kembali
                   </div>
                </a>
            </div>
            <div class="card-body">
                <div class="text-center mt-3">
                    <a href="" id="mulai_tes" class="btn btn-primary">Mulai Tes ?</a>
                </div>
                <div id="tes" style="display: none;">
                    <p>{{ $tes->keterangan }}</p>
                    <div class="text-right">
                        <a href="" class="btn btn-primary">Unduh File</a>
                    </div>
                    <form action="">
                        <div class="mt-4">
                            <div class="mb-3">
                                <label for="file_upload" class="form-label">Upload File</label>
                                <input type="file" name="file_upload" id="file_upload" class="form-control">
                            </div>
                        </div>
                        <div class="text-left">
                            <a href="" class="btn btn-success">Upload</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('tesDimulai')) {
                document.getElementById('tes').style.display = 'block';
                document.getElementById('mulai_tes').style.display = 'none';
            }
            document.getElementById('mulai_tes').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('tes').style.display = 'block';
                document.getElementById('mulai_tes').style.display = 'none';
                localStorage.setItem('tesDimulai', 'true');
            });
        });
    </script>
@endsection
