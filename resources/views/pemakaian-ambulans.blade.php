<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pemakaian Ambulans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            font-weight: bold;
        }

        .table-container {
            width: 100%;
            /* tambah ini */
            overflow-x: auto;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-size: 15px;
        }

        .table-container table {
            width: 100%;
            /* tambah ini agar tabel stretch */
        }

        table th,
        table td {
            white-space: nowrap;
            /* agar teks tidak turun ke bawah */
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="container-fluid mt-5">
        <h1 class="mb-4 text-center">📊 Dashboard Pemakaian Ambulans</h1>

        <div class="mb-3 text-end">
            <a href="{{ route('pemakaian.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>PMI Cabang</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Pemohon</th>
                        <th>Instansi</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Jenis Ambulans</th>
                        <th>Untuk Kegiatan</th>
                        <th>Tujuan</th>
                        <th>Kebutuhan</th>
                        <th>Kebutuhan Tanggal</th>
                        <th>Kebutuhan Jam</th>
                        <th>Kebutuhan Administrasi</th>
                        <th>Diisi Pada</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->pmi_cabang }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jam }}</td>
                            <td>{{ $item->nama_pemohon }}</td>
                            <td>{{ $item->instansi }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_telepon }}</td>
                            <td>{{ $item->jenis_ambulans }}</td>
                            <td>{{ $item->untuk_kegiatan }}</td>
                            <td>{{ $item->tujuan }}</td>
                            <td>{{ $item->kebutuhan }}</td>
                            <td>{{ $item->kebutuhan_tanggal }}</td>
                            <td>{{ $item->kebutuhan_jam }}</td>
                            <td>{{ $item->administrasi }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>