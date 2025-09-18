<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemakaian Ambulans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar bg-light px-3">
        <div class="d-flex align-items-center">
            <img class="logo-pmi" src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI" height="50">
            <h1 class="ms-3 h4">Formulir Pemakaian Ambulans PMI Kota Bogor</h1>
        </div>
    </nav>

    <!-- FORM CARD -->
    <div class="container my-4">
        <div class="card shadow p-4">
            <form id="formAmbulans" action="{{ route('pemakaian-ambulans.store') }}" method="POST">
                @csrf

                <!-- BARIS 1 -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control"
                               value="{{ old('tanggal') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="waktu" class="form-label">Waktu</label>
                        <input type="time" id="waktu" name="waktu" class="form-control"
                               value="{{ old('waktu') }}" required>
                    </div>
                </div>

                <!-- BARIS 2 -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_pasien" class="form-label">Nama Pasien</label>
                        <input type="text" id="nama_pasien" name="nama_pasien" class="form-control"
                               value="{{ old('nama_pasien') }}" required placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="col-md-6">
                        <label for="instansi" class="form-label">Instansi/Organisasi/Perorangan</label>
                        <input type="text" id="instansi" name="instansi" class="form-control"
                               value="{{ old('instansi') }}" placeholder="Masukkan instansi atau organisasi">
                    </div>
                </div>

                <!-- BARIS 3 -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control"
                                  placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="no_telepon" class="form-label">No. Telepon</label>
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control"
                               pattern="[0-9]{10,15}" value="{{ old('no_telepon') }}"
                               placeholder="Contoh: 081234567890" required>
                    </div>
                </div>

                <!-- BARIS 4 -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenis_ambulans" class="form-label">Jenis Ambulans</label>
                        <select id="jenis_ambulans" name="jenis_ambulans" class="form-select" required>
                            <option value="" disabled {{ old('jenis_ambulans') ? '' : 'selected' }}>-Pilih-</option>
                            <option value="Gawat Darurat" {{ old('jenis_ambulans') == 'Gawat Darurat' ? 'selected' : '' }}>Gawat Darurat</option>
                            <option value="Transportasi" {{ old('jenis_ambulans') == 'Transportasi' ? 'selected' : '' }}>Transportasi</option>
                            <option value="Jenazah" {{ old('jenis_ambulans') == 'Jenazah' ? 'selected' : '' }}>Jenazah</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="untuk_kegiatan" class="form-label">Untuk Kegiatan</label>
                        <textarea id="untuk_kegiatan" name="untuk_kegiatan"
                                  class="form-control" required>{{ old('untuk_kegiatan') }}</textarea>
                    </div>
                </div>

                <!-- BARIS 5 -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <select id="tujuan" name="tujuan" class="form-select" required>
                            <option value="" disabled {{ old('tujuan') ? '' : 'selected' }}>-Pilih-</option>
                            <option value="Dalam Kota" {{ old('tujuan') == 'Dalam Kota' ? 'selected' : '' }}>Dalam Kota</option>
                            <option value="Luar Kota" {{ old('tujuan') == 'Luar Kota' ? 'selected' : '' }}>Luar Kota</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dibutuhkan</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="segera" name="kebutuhan" value="Segera" class="form-check-input"
                                   {{ old('kebutuhan') == 'Segera' ? 'checked' : '' }} required>
                            <label for="segera" class="form-check-label">Segera</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="terencana" name="kebutuhan" value="Terencana" class="form-check-input"
                                   {{ old('kebutuhan') == 'Terencana' ? 'checked' : '' }} required>
                            <label for="terencana" class="form-check-label">Terencana</label>
                        </div>
                    </div>
                </div>

                <!-- BARIS 6 -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kebutuhan_tanggal" class="form-label">Tanggal Kebutuhan</label>
                        <input type="date" id="kebutuhan_tanggal" name="kebutuhan_tanggal" class="form-control"
                               value="{{ old('kebutuhan_tanggal') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="kebutuhan_jam" class="form-label">Jam Kebutuhan</label>
                        <input type="time" id="kebutuhan_jam" name="kebutuhan_jam" class="form-control"
                               value="{{ old('kebutuhan_jam') }}">
                    </div>
                </div>

                <!-- BARIS 7 -->
                <div class="mb-3">
                    <label for="administrasi" class="form-label">Administrasi</label>
                    <select id="administrasi" name="administrasi" class="form-select" required>
                        <option value="" disabled {{ old('administrasi') ? '' : 'selected' }}>-Pilih-</option>
                        <option value="Gratis" {{ old('administrasi') == 'Gratis' ? 'selected' : '' }}>Gratis</option>
                        <option value="Bayar di Lokasi" {{ old('administrasi') == 'Bayar di Lokasi' ? 'selected' : '' }}>Bayar di Lokasi</option>
                        <option value="Bayar di Kantor PMI" {{ old('administrasi') == 'Bayar di Kantor PMI' ? 'selected' : '' }}>Bayar di Kantor PMI</option>
                    </select>
                </div>

                <!-- SUBMIT -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <!-- KONFIRMASI SUBMIT -->
    <script>
        document.getElementById('formAmbulans').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Kirim Formulir?',
                text: "Pastikan data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>

    <!-- NOTIFIKASI BERHASIL -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session("success") }}',
                timer: 2000,
                showConfirmButton: false,
                didClose: () => {
                    window.location.href = "{{ route('pemakaian-ambulans.index') }}";
                }
            });
        </script>
    @endif
</body>
</html>