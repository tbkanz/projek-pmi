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
            <label>PMI Cabang</label>
            <input type="text" name="pmi_cabang" required placeholder="Masukkan cabang PMI, misal: Bogor">

            <label>Tanggal</label>
            <input type="date" name="tanggal" required>

            <label>Jam</label>
            <input type="time" name="jam" required>

            <label>Nama Pemohon</label>
            <input type="text" name="nama_pemohon" required placeholder="Masukkan nama lengkap">

            <label>Instansi/Organisasi/Perorangan</label>
            <input type="text" name="instansi" placeholder="Masukkan nama instansi atau organisasi">

            <label>Alamat</label>
            <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>

            <label>No. Telepon</label>
            <input type="tel" name="no_telepon" pattern="[0-9]{10,15}" placeholder="Contoh: 081234567890">

            <label>Jenis Ambulans</label>
            <select name="jenis_ambulans" required>
                <option value="" disabled selected>-Pilih-</option>
                <option value="Gawat Darurat">Gawat Darurat</option>
                <option value="Transportasi">Transportasi</option>
                <option value="Jenazah">Jenazah</option>
            </select>

            <label>Untuk Kegiatan</label>
            <textarea name="untuk_kegiatan" placeholder="Deskripsikan kegiatan penggunaan ambulans"></textarea>

            <label>Tujuan</label>
            <select name="tujuan" required>
                <option value="" disabled selected>-Pilih-</option>
                <option value="Dalam Kota">Dalam Kota</option>
                <option value="Luar Kota">Luar Kota</option>
            </select>

            <label>Dibutuhkan</label>
            <div class="dibutuhkan-group">
                <label class="radio-option">
                    <input type="radio" name="kebutuhan" value="Segera" required> Segera
                </label>
                <label class="radio-option">
                    <input type="radio" name="kebutuhan" value="Terencana" required> Terencana
                </label>
            </div>

            <label>Tanggal Kebutuhan</label>
            <input type="date" name="kebutuhan_tanggal">

            <label>Jam Kebutuhan</label>
            <input type="time" name="kebutuhan_jam">

            <label>Administrasi</label>
            <select name="administrasi" required>
                <option value="" disabled selected>-Pilih-</option>
                <option value="Gratis">Gratis</option>
                <option value="Bayar di Lokasi">Bayar di Lokasi</option>
                <option value="Bayar di Kantor PMI">Bayar di Kantor PMI</option>
            </select>

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