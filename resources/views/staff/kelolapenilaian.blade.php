@extends('components.home', ['title' => 'Halaman Staff'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="text-white">Kelola Penilaian</h3>
            </div>
            <div class="card-body mt-4">
                <table id="kelola_penilaian" class="table table-responsive table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th>No</th>
                            <th>Lowongan</th>
                            <th>Nilai Tes</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#kelola_penilaian');
    </script>
@endsection
