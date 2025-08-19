<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemakaian Ambulans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<navbar class="navbar">
    <div class="logo">
        <img class="logo-pmi" src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI">
    </div>
    <h1 class="judul">Formulir Pemakaian Ambulans PMI Kota Bogor</h1>
</navbar>

<body>
    <div class="form-container">
        <form id="formAmbulans" action="{{ route('pemakaian.store') }}" method="POST">
            @csrf
            <div class="row mb-2">
                <div class="col-6">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="col-6">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control" required>
                </div>
            </div>

            <!-- BARIS 2 -->
            <div class="row mb-2">
                <div class="col-6">
                    <label>Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" required
                        placeholder="Masukkan nama lengkap">
                </div>
                <div class="col-6">
                    <label>Instansi/Organisasi/Perorangan</label>
                    <input type="text" name="instansi" class="form-control"
                        placeholder="Masukkan nama instansi atau organisasi">
                </div>
            </div>

            <!-- BARIS 3 -->
            <div class="row mb-2">
                <div class="col-6">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                </div>
                <div class="col-6">
                    <label>No. Telepon</label>
                    <input type="tel" name="no_telepon" class="form-control" pattern="[0-9]{10,15}"
                        placeholder="Contoh: 081234567890">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label>Jenis Ambulans</label>
                    <select name="jenis_ambulans" required>
                        <option value="" disabled selected>-Pilih-</option>
                        <option value="Gawat Darurat">Gawat Darurat</option>
                        <option value="Transportasi">Transportasi</option>
                        <option value="Jenazah">Jenazah</option>
                    </select>
                </div>
                <div class="col-6">
                    <label>Untuk Kegiatan</label>
                    <textarea name="untuk_kegiatan" placeholder="Deskripsikan kegiatan penggunaan ambulans"></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label>Tujuan</label>
                    <select name="tujuan" required>
                        <option value="" disabled selected>-Pilih-</option>
                        <option value="Dalam Kota">Dalam Kota</option>
                        <option value="Luar Kota">Luar Kota</option>
                    </select>
                </div>
                <div class="col-6">
                    <label>Dibutuhkan</label>
                    <div>
                        <label>
                            <input type="radio" name="kebutuhan" value="Segera" required> Segera
                        </label>
                        <label>
                            <input type="radio" name="kebutuhan" value="Terencana" required> Terencana
                        </label>
                    </div>
                </div>
            </div>
            <label>Tanggal Kebutuhan</label>
            <input type="date" name="kebutuhan_tanggal">

            <label>Jam Kebutuhan</label>
            <input type="time" name="kebutuhan_jam">

            <div>
                <label>Administrasi</label>
                <select name="administrasi" required>
                    <option value="" disabled selected>-Pilih-</option>
                    <option value="Gratis">Gratis</option>
                    <option value="Bayar di Lokasi">Bayar di Lokasi</option>
                    <option value="Bayar di Kantor PMI">Bayar di Kantor PMI</option>
                </select>
            </div>
            <button type="submit">Kirim</button>
        </form>
    </div>

    {{-- KONFIRMASI SEBELUM SUBMIT --}}
    <script>
        const form = document.getElementById('formAmbulans');
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // tahan submit

            Swal.fire({
                title: 'Kirim Formulir?',
                text: "Pastikan data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit jika user memilih ya
                }
            });
        });
    </script>

    {{-- NOTIFIKASI BERHASIL SETELAH REDIRECT --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session("success") }}',
                timer: 2000,
                showConfirmButton: false
            }).then(function () {
                window.location.href = "{{ route('pemakaian-ambulans') }}";
            });
        </script>
    @endif
</body>

</html>