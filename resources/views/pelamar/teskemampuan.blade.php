@extends('components.home', ['title' => 'Tes Kemampuan - Pelamar'])

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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>{{ $tes->keterangan }}</p>
                    <div class="text-right">
                       @if ($tes->file_download != null)
                       <a href="{{ route('pelamar.download.file', $tes->file_download) }}"
                        class="text-primary">{{ $tes->file_download }}</a>
                        @else
                        <a href="{{ $tes->url }}" target="_blank"
                         class="text-primary">{{ $tes->url }}</a>
                       @endif
                    </div>
                    <form action="{{ route('pelamar.upload.file', $tes->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tes_id" value="{{ $tes->id }}">
                        <input type="hidden" name="syarat_id" value="{{ $syarat->id }}">
                        <div class="mt-4">
                            <div class="mb-3">
                                <label for="file_upload" class="form-label">Upload File</label>
                                <input type="file" name="file_upload" id="file_upload" class="form-control">
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-success">Upload</button>
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
