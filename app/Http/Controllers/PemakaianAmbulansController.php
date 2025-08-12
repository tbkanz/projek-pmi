<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemakaianAmbulans;

class PemakaianAmbulansController extends Controller
{
    /**
     * Menampilkan semua data di dashboard.
     */
    public function index()
    {
        // Ambil semua data terbaru dari database
        $data = PemakaianAmbulans::oldest()->get();

        // Kirim data ke view dashboard
        return view('pemakaian-ambulans', compact('data'));
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('form-ambulans');
    }

    /**
     * Menyimpan data baru dari form.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'pmi_cabang'         => 'required|string|max:100',
            'tanggal'            => 'required|date',
            'jam'                => 'required',
            'nama_pemohon'       => 'required|string|max:100',
            'instansi'           => 'nullable|string|max:150',
            'alamat'             => 'nullable|string',
            'no_telepon'         => 'nullable|string|max:20',
            'jenis_ambulans'     => 'required|in:Gawat Darurat,Transportasi,Jenazah',
            'untuk_kegiatan'     => 'nullable|string',
            'tujuan'             => 'required|in:Dalam Kota,Luar Kota',
            'kebutuhan'          => 'required|in:Segera,Terencana',
            'kebutuhan_tanggal'  => 'nullable|date',
            'kebutuhan_jam'      => 'nullable',
            'administrasi'       => 'required|in:Gratis,Bayar di Lokasi,Bayar di Kantor PMI',
        ]);

        // Simpan data ke database
        PemakaianAmbulans::create($validated);

        // Redirect ke dashboard dengan pesan sukses
        return redirect()
            ->route('pemakaian.index')
            ->with('success', 'Data berhasil disimpan!');
    }
}
