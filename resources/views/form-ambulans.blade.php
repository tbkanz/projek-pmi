<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemakaian Ambulans</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>



    <!-- HEADER -->
    <navbar class="navbar">
        <div class="logo">
            <img class="logo-pmi" src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI">
        </div>
        <h1 class="judul">Formulir Pemakaian Ambulans PMI Kota Bogor</h1>
    </navbar>

    <body>
    <!-- FORM dibungkus container supaya bisa diatur lebar dan posisi -->
    <div class="form-container">
        <form action="{{ route('pemakaian.store') }}" method="POST">
            @csrf
            <label>PMI Cabang</label>
            <input type="text" name="pmi_cabang" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" required>

            <label>Jam</label>
            <input type="time" name="jam" required>

            <label>Nama Pemohon</label>
            <input type="text" name="nama_pemohon" required>

            <label>Instansi/Organisasi/Perorangan</label>
            <input type="text" name="instansi">

            <label>Alamat</label>
            <textarea name="alamat"></textarea>

            <label>No. Telepon</label>
            <input type="tel" name="no_telepon" pattern="[0-9]{10,15}">

            <label>Jenis Ambulans</label>
            <select name="jenis_ambulans" required>
                <option value="Pilih">-Pilih-</option>
                <option value="Gawat Darurat">Gawat Darurat</option>
                <option value="Transportasi">Transportasi</option>
                <option value="Jenazah">Jenazah</option>
            </select>

            <label>Untuk Kegiatan</label>
            <textarea name="untuk_kegiatan"></textarea>

            <label>Tujuan</label>
            <select name="tujuan" required>
                <option value="Pilih">-Pilih-</option>
                <option value="Dalam Kota">Dalam Kota</option>
                <option value="Luar Kota">Luar Kota</option>
            </select>

            <label>Dibutuhkan</label>
            <div class="dibutuhkan-group">
                <div class="dibutuhkan-item">
                    <label class="radio-option">
                        <input type="radio" name="kebutuhan" value="Segera">
                        Segera
                    </label>
                    <input type="date" name="kebutuhan_tanggal">
                    <input type="time" name="kebutuhan_jam">
                </div>

                <div class="dibutuhkan-item">
                    <label class="radio-option">
                        <input type="radio" name="kebutuhan" value="Terencana">
                        Terencana
                    </label>
                    <input type="date" name="kebutuhan_tanggal">
                    <input type="time" name="kebutuhan_jam">
                </div>
            </div>


            <label>Administrasi</label>
            <select name="administrasi" required>
                <option value="Pilih">-Pilih-</option>
                <option value="Gratis">Gratis</option>
                <option value="Bayar di Lokasi">Bayar di Lokasi</option>
                <option value="Bayar di Kantor PMI">Bayar di Kantor PMI</option>
            </select>

            <button type="submit">Kirim</button>
        </form>
    </div>

</body>

</html>