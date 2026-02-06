<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemakaian Ambulans</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- NAVBAR CUSTOM -->
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

    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Edit Data Pemakaian Ambulans</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pemakaian-ambulans.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal', $data->tanggal) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="time" class="form-control" id="waktu" name="waktu"
                                value="{{ old('waktu', $data->waktu) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_pasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                            value="{{ old('nama_pasien', $data->nama_pasien) }}">
                    </div>

                    <div class="mb-3">
                        <label for="instansi" class="form-label">Instansi (Opsional)</label>
                        <input type="text" class="form-control" id="instansi" name="instansi"
                            value="{{ old('instansi', $data->instansi) }}">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"
                            rows="2">{{ old('alamat', $data->alamat) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                value="{{ old('no_telepon', $data->no_telepon) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_ambulans" class="form-label">Jenis Ambulans</label>
                            <input type="text" class="form-control" id="jenis_ambulans" name="jenis_ambulans"
                                value="{{ old('jenis_ambulans', $data->jenis_ambulans) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="untuk_kegiatan" class="form-label">Untuk Kegiatan</label>
                            <input type="text" class="form-control" id="untuk_kegiatan" name="untuk_kegiatan"
                                value="{{ old('untuk_kegiatan', $data->untuk_kegiatan) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan"
                                value="{{ old('tujuan', $data->tujuan) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kebutuhan" class="form-label">Kebutuhan</label>
                            <input type="text" class="form-control" id="kebutuhan" name="kebutuhan"
                                value="{{ old('kebutuhan', $data->kebutuhan) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="administrasi" class="form-label">Administrasi</label>
                            <input type="text" class="form-control" id="administrasi" name="administrasi"
                                value="{{ old('administrasi', $data->administrasi) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kebutuhan_tanggal" class="form-label">Kebutuhan Tanggal (Opsional)</label>
                            <input type="date" class="form-control" id="kebutuhan_tanggal" name="kebutuhan_tanggal"
                                value="{{ old('kebutuhan_tanggal', $data->kebutuhan_tanggal) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kebutuhan_jam" class="form-label">Kebutuhan Jam (Opsional)</label>
                            <input type="time" class="form-control" id="kebutuhan_jam" name="kebutuhan_jam"
                                value="{{ old('kebutuhan_jam', $data->kebutuhan_jam) }}">
                        </div>
                    </div>

                    <div class="button-group text-end">
                        <a href="{{ route('pemakaian-ambulans.index') }}" class="back">Kembali</a>
                        <button type="submit" class="update">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>