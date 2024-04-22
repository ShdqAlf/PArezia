<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tes Pelamar</title>
    <style>
        /* Gaya CSS untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Gaya CSS untuk status penerimaan */
        .bg-success {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .bg-danger {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="table-responsive">
        <div class="card-header bg-light">
            <h2 class="text-white">Laporan Tes Pelamar</h2>
        </div>
        <table id="laporantes">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelamar</th>
                    <th>Nama Lowongan</th>
                    <th>Nilai Qi</th>
                    <th>Ranking</th>
                    <th>Status Penerimaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->lowongan->judul ?? 'Pelamar sudah ditolak' }}</td>
                    <td>{{ $item->nilaiakhir->nilaiqi ?? 'Pelamar sudah ditolak' }}</td>
                    <td>{{ $item->nilaiakhir->rangking ?? 'Pelamar sudah ditolak' }}</td>
                    <td>
                        @if ($item->status_tes == 'Diterima')
                        <span class="bg-success">{{ $item->status_tes }}</span>
                        @elseif($item->status_tes == 'Ditolak')
                        <span class="bg-danger">{{ $item->status_tes }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>