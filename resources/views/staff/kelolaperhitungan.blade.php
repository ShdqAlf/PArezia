@extends('components.home', ['title' => 'Kelola Perhitungan'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#kelola_perhitungan');
    </script>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Kelola Perhitungan</h3>
            </div>
            <div class="card-body">
                <table id="kelola_perhitungan" class="table table-responsive table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>No</th>
                            <th>Lowongan</th>
                            <th>Nilai Tes</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
