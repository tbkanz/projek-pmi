<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianAmbulans extends Model
{
    use HasFactory;

    protected $table = 'pemakaian_ambulans';

    protected $fillable = [
        'tanggal',
        'waktu',
        'nama_pasien',
        'instansi',
        'alamat',
        'no_telepon',
        'jenis_ambulans',
        'untuk_kegiatan',
        'tujuan',
        'kebutuhan',
        'kebutuhan_tanggal',
        'kebutuhan_jam',
        'administrasi',
    ];
}