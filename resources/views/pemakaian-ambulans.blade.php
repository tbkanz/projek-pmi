<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemakaian Ambulans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <nav class="custom-navbar">
        <div class="logo">
            <img class="logo-pmi" src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI">
        </div>
        <h1 class="judul">Dashboard Pemakaian Ambulans</h1>
    </nav>

    <div class="text-end mt-3">
        <a href="{{ url('form-ambulans') }}" class="btn btn-primary btn-tambah">Tambah Data</a>
    </div>

    <!-- Tabel Data -->
    <div class="container-fluid">
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
                        <th>No.Telepon</th>
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
                            <td>{{ $item->nama_pemohon }}</td>
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
                            <td colspan="16" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Map & Foto Bersebelahan -->
        <div class="row mt-3 mb-4">
            <!-- Map -->
            <div class="col-md-6">
                <h1 style="font-size: 25px;">Map PMI Kota Bogor</h1>
                <div style="width:100%; height:350px;">
                    <iframe width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q=PMI+Bogor,Jawabarat,Indonesia&amp;output=embed">
                    </iframe>
                </div>
            </div>

            <!-- Foto -->
            <div class="col-md-6 d-flex flex-column align-items-center">
                <h1 style="font-size: 25px;">Foto Kantor PMI</h1>
                <img class="foto-kantor-pmi" src="{{ asset('storage/foto-kantor-pmi.jpeg') }}" alt="Foto Kantor PMI"
                    style="width:100%; max-height:350px; object-fit:cover; border-radius:8px;">
            </div>
        </div>

    </div>

    <!-- JQuery + DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#ambulansTable').DataTable({
                pageLength: 5,
                autoWidth: false,    // <= penting agar width dari CSS diterapkan
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

    {{-- SweetAlert notifikasi berhasil setelah redirect --}}
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