<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemakaian Ambulans</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* PERBAIKAN: agar ukuran map dan foto selalu sama */
        .media-wrapper {
            width: 100%;
            height: 320px;
            overflow: hidden;
            border-radius: 10px;
        }

        .media-wrapper iframe,
        .media-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="custom-navbar d-flex align-items-center px-3">
        <div class="logo">
            <img class="logo-pmi" src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI">
        </div>
        <h1 class="judul ms-3">Pemakaian Ambulans</h1>
        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger px-4">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Tombol Tambah -->
    <div class="text-end mt-3 me-3">
        <a href="{{ route('pemakaian-ambulans.create') }}" class="btn btn-primary btn-tambah">Tambah Data</a>
    </div>

    <!-- Tabel Data -->
    <div class="container-fluid mt-3">
        <div class="table-container">
            <table id="ambulansTable" class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kebutuhan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Pemohon</th>
                        <th>Instansi</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Ambulans</th>
                        <th>Kegiatan</th>
                        <th>Tujuan</th>
                        <th>Kebutuhan Administrasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kebutuhan }}</td>
                            <td>{{ $item->kebutuhan_tanggal }}</td>
                            <td>{{ $item->kebutuhan_jam }}</td>
                            <td>{{ $item->nama_pasien }}</td>
                            <td>{{ $item->instansi }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_telepon }}</td>
                            <td>{{ $item->jenis_ambulans }}</td>
                            <td>{{ $item->untuk_kegiatan }}</td>
                            <td>{{ $item->tujuan }}</td>
                            <td>{{ $item->administrasi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Map & Foto -->
        <div class="row mt-3 mb-4">

            <div class="col-md-6">
                <div class="info-card">
                    <h1 class="section-title">Map PMI Kota Bogor</h1>

                    <!-- PERBAIKAN WRAPPER -->
                    <div class="media-wrapper">
                        <iframe src="https://www.google.com/maps/embed?pb=..."
                                allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card text-center">
                    <h1 class="section-title">Foto Kantor PMI</h1>

                    <!-- PERBAIKAN WRAPPER -->
                    <div class="media-wrapper">
                        <img class="foto-kantor-pmi" src="{{ asset('storage/foto-kantor-pmi.jpeg') }}" alt="Foto Kantor PMI">
                    </div>

                </div>
            </div>
        </div>

        <!-- Grafik -->
        <div class="row mt-4 mb-5">
            <div class="col-md-12">
                <div class="info-card">
                    <h1 class="section-title text-center mb-4">Grafik Pemakaian Ambulans per Bulan</h1>
                    <canvas id="ambulansChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ambulansChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    label: 'Jumlah Pemakaian',
                    data: @json(array_values($ambulansPerBulan ?? array_fill(0, 12, 0))),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    </script>

    <!-- JQuery + DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#ambulansTable').DataTable({
                pageLength: 5,
                autoWidth: false,
                responsive: true,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        });
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif
</body>
</html>