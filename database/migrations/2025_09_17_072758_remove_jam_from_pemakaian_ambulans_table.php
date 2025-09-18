<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pemakaian_ambulans', function (Blueprint $table) {
            $table->dropColumn('jam');
        });
    }

    public function down(): void {
        Schema::table('pemakaian_ambulans', function (Blueprint $table) {
            $table->time('jam')->nullable();
        });
    }
};
