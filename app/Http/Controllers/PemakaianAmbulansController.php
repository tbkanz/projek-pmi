<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemakaianAmbulans;
use Carbon\Carbon;

class PemakaianAmbulansController extends Controller
{
    public function index()
    {
        $data = PemakaianAmbulans::latest()->get();

        // Tahun sekarang
        $tahun = Carbon::now()->year;

        // Hitung jumlah pemakaian per bulan untuk tahun ini
        $ambulansPerBulan = PemakaianAmbulans::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal', $tahun)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        // Buat array 12 bulan default = 0
        $perBulan = array_fill(1, 12, 0);
        foreach ($ambulansPerBulan as $bulan => $jumlah) {
            $perBulan[$bulan] = $jumlah;
        }

        return view('pemakaian-ambulans', [
            'data' => $data,
            'ambulansPerBulan' => $perBulan,
        ]);
    }

    public function create()
    {
        return view('form-ambulans');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'           => 'required|date',
            'waktu'             => 'required',
            'nama_pasien'       => 'required|string|max:255',
            'instansi'          => 'nullable|string|max:255',
            'alamat'            => 'required|string',
            'no_telepon'        => 'required|string|max:15',
            'jenis_ambulans'    => 'required|string',
            'untuk_kegiatan'    => 'required|string',
            'tujuan'            => 'required|string',
            'kebutuhan'         => 'required|string',
            'kebutuhan_tanggal' => 'nullable|date',
            'kebutuhan_jam'     => 'nullable',
            'administrasi'      => 'required|string',
        ]);

        PemakaianAmbulans::create($validated);

        return redirect()->route('pemakaian-ambulans.create')
            ->with('success', 'Data pemakaian ambulans berhasil disimpan.');
    }
}
