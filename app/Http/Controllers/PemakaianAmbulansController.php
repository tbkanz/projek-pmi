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

        $tahun = Carbon::now()->year;

        $ambulansPerBulan = PemakaianAmbulans::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal', $tahun)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

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
        $validated = $this->validateForm($request);

        PemakaianAmbulans::create($validated);

        return redirect()->route('pemakaian-ambulans.index')
            ->with('success', 'Data pemakaian ambulans berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PemakaianAmbulans::findOrFail($id);
        return view('edit-ambulans', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateForm($request);

        PemakaianAmbulans::findOrFail($id)->update($validated);

        return redirect()->route('pemakaian-ambulans.index')
            ->with('success', 'Data pemakaian ambulans berhasil diupdate.');
    }

    public function destroy($id)
    {
        PemakaianAmbulans::findOrFail($id)->delete();

        return redirect()->route('pemakaian-ambulans.index')
            ->with('success', 'Data pemakaian ambulans berhasil dihapus.');
    }

    private function validateForm(Request $request)
    {
        return $request->validate([
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
    }
}