@extends('components.home', ['title' => 'Syarat Lowongan - Pelamar'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Syarat Lowongan</h3>
                <p class="text-white">Berakhir Pada Tanggal :
                    {{ \Carbon\Carbon::parse($lowongan->tanggal_berakhir)->locale('id_ID')->isoFormat('D MMMM Y') }}
                </p>
                <a href="{{ route('pelamar.dashboard') }}" class="btn btn-secondary text-white">
                    <div class="d-flex align-items-center">
                        <i data-feather="chevron-left" width="20"></i>
                        Kembali
                    </div>
                </a>
            </div>
            <div class="card-body">
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header bg-light mt-3">
                        <p class="text-white">Pada Syarat Lowongan, anda harus menambahkan CV dan juga Dokumen Tambahan</p>
                    </div>
                    <form action="{{ route('pelamar.syarat.upload', $lowongan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
                        <div class="mt-4">
                            <div class="mb-3">
                                <label for="cv" class="form-label">Upload CV</label>
                                <input type="file" name="cv" id="cv" class="form-control">
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="mb-3">
                                <label for="pendidikan_terakhir" class="form-label">Riwayat Pendidikan</label>
                                <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-select">
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="D3">D3</option>
                                    <option value="D4">D4</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="mb-3">
                                <label for="pengalaman_terakhir" class="form-label">Riwayat Pengalaman</label>
                                <select name="pengalaman_terakhir" id="pengalaman_terakhir" class="form-select">
                                    <option value="<= 1 Tahun"><= 1 Tahun</option>
                                    <option value="1 Tahun >= 2 Tahun">1 Tahun >= 2 Tahun</option>
                                    <option value="1 Tahun >= 5 Tahun">1 Tahun >= 5 Tahun</option>
                                    <option value="1 Tahun >= 10 Tahun">1 Tahun >= 10 Tahun</option>
                                </select>
                            </div>
                        </div>
                        <h5 class="fw-bold">Dokumen Tambahan</h5>
                        <p>
                        <ul>
                            <li>Surat Ijazah</li>
                            <li>Surat Lamaran</li>
                        </ul>
                        </p>
                        <div class="mt-4">
                            <div class="mb-3">
                                <label for="dokumen_lainnya" class="form-label">Upload Dokumen Tambahan</label>
                                <input type="file" name="dokumen_lainnya" id="dokumen_lainnya" class="form-control">
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
@endsection
