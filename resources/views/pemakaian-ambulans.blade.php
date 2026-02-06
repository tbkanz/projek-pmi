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
</head>

<body>

    <!-- NAVBAR -->
    <nav class="custom-navbar d-flex align-items-center px-3">
        <div class="logo">
            <img class="logo-pmi" src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI">
        </div>
        <h1 class="judul ms-3">Pemakaian Ambulans</h1>
        <div class="ms-auto">
            <!-- Logout menggunakan POST -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger px-4">Logout</button>
            </form>
        </div>
    </nav>

    <!-- TOMBOL TAMBAH -->
    <div class="text-end mt-3 me-3">
        <a href="{{ route('pemakaian-ambulans.create') }}" class="btn btn-primary btn-tambah">Tambah Data</a>
    </div>

    <!-- TABEL DATA -->
    <div class="container mt-4">
        <div class="table-container">
            <table id="ambulansTable" class="table table-bordered table-hover align-middle">
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
                        <th>Aksi</th>
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
                            <td class="text-center">
                                <a href="{{ route('pemakaian-ambulans.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm mb-1">Edit</a>

                                <form action="{{ route('pemakaian-ambulans.destroy', $item->id) }}" method="POST"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MAP & FOTO -->
    <div class="row mt-2 mb-4 justify-content-center">

        <!-- MAP -->
        <div class="col-md-5 col-lg-5">
            <h1 class="section-title">MAP PMI KOTA BOGOR</h1>
            <div class="info-card">
                <div class="media-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5862408734556!2d106.80931207505061!3d-6.573787564262417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c4242ab014dd%3A0x7e887b772ca00377!2sPMI%20Kota%20Bogor!5e0!3m2!1sen!2sus!4v1769329401895!5m2!1sen!2sus"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- FOTO -->
        <div class="col-md-5 col-lg-5">
            <h1 class="section-title">FOTO KANTOR PMI</h1>
            <div class="info-card">
                <div class="media-wrapper">
                    <img src="{{ asset('storage/foto-kantor-pmi.jpg') }}" alt="Foto Kantor PMI" class="img-fluid">
                </div>
            </div>
        </div>

    </div>

    <!-- GRAFIK -->
    <div class="grafik row mt-4 mb-5 justify-content-center">
        <div class="col-md-10">
            <h1 class="section-title">GRAFIK PEMAKAIAN AMBULANS PER BULAN</h1>
            <div class="info-card chart">
                <canvas id="ambulansChart" height="120"></canvas>
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
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Jumlah Pemakaian',
                    data: @json(array_values($ambulansPerBulan)),
                    backgroundColor: 'rgba(54,162,235,0.7)',
                    borderColor: 'rgba(54,162,235,1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
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
                responsive: true,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data tersedia",
                    search: "Cari:",
                    paginate: { next: "›", previous: "‹" }
                }
            });

            $('.form-delete').on('submit', function (e) {
                e.preventDefault();
                let form = this;
                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>

    <!-- SweetAlert Success -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

</body>

</html>