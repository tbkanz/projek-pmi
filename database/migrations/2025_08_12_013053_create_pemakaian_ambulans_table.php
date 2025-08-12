<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pemakaian_ambulans', function (Blueprint $table) {
        $table->id();
        $table->string('pmi_cabang');
        $table->date('tanggal');
        $table->time('jam');
        $table->string('nama_pemohon');
        $table->string('instansi')->nullable();
        $table->text('alamat')->nullable();
        $table->string('no_telepon')->nullable();
        $table->enum('jenis_ambulans', ['Gawat Darurat', 'Transportasi', 'Jenazah']);
        $table->text('untuk_kegiatan')->nullable();
        $table->enum('tujuan', ['Dalam Kota', 'Luar Kota']);
        $table->enum('kebutuhan', ['Segera', 'Terencana']);
        $table->date('kebutuhan_tanggal')->nullable();
        $table->time('kebutuhan_jam')->nullable();
        $table->enum('administrasi', ['Gratis', 'Bayar di Lokasi', 'Bayar di Kantor PMI']);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian_ambulans');
    }
};
