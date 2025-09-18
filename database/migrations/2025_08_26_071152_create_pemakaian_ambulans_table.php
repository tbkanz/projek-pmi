<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemakaian_ambulans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('nama_pasien');
            $table->string('instansi')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->string('jenis_ambulans');
            $table->string('untuk_kegiatan')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('kebutuhan')->nullable();
            $table->date('kebutuhan_tanggal');
            $table->time('kebutuhan_jam');
            $table->string('administrasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemakaian_ambulans');
    }
};
