<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemakaianAmbulans;
use Illuminate\Support\Facades\DB;

class PemakaianAmbulansController extends Controller
{
    public function index()
    {
        // Ambil jumlah pemakaian per bulan
        $rawData = PemakaianAmbulans::select(
            DB::raw("MONTH(tanggal) as bulan"),
            DB::raw("COUNT(*) as total")
        )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Buat array 12 bulan (Jan–Des) default 0
        $ambulansPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $ambulansPerBulan[] = $rawData[$i] ?? 0;
        }

        // Data tabel
        $data = PemakaianAmbulans::orderBy('tanggal', 'desc')->get();

        return view('pemakaian-ambulans', compact('data', 'ambulansPerBulan'));
    }

    public function create()
    {
        // Tampilkan form input data baru
        return view('form-ambulans');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'           => 'required|date',
            'jam'               => 'required',
            'nama_pemohon'      => 'required|string|max:255',
            'instansi'          => 'nullable|string|max:255',
            'alamat'            => 'nullable|string',
            'no_telepon'        => 'nullable|string|max:20',
            'jenis_ambulans'    => 'required|string',
            'untuk_kegiatan'    => 'nullable|string',
            'tujuan'            => 'nullable|string',
            'kebutuhan'         => 'nullable|string',
            'kebutuhan_tanggal' => 'required|date',
            'kebutuhan_jam'     => 'required',
            'administrasi'      => 'nullable|string',
        ]);

        PemakaianAmbulans::create($validated);

        return redirect()
            ->route('pemakaian-ambulans')
            ->with('success', 'Data berhasil ditambahkan');
    }
}