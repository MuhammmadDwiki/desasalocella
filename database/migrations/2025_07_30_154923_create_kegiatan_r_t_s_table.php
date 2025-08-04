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
        Schema::create('kegiatan_r_t_s', function (Blueprint $table) {
            $table->string('id_kegiatan')->primary();
            $table->string('tanggal_kegiatan');
            $table->string('lokasi_kegiatan');
            $table->string('waktu_kegiatan');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_r_t_s');
    }
};
