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
        Schema::create('detail_rekapitulasis', function (Blueprint $table) {
            $table->string('id_detail_rekap')->primary();
            $table->string('id_rekap');
            $table->string('kelompok_umur');
            $table->integer('jumlah_laki_laki_awal')->default(0);
            $table->integer('jumlah_perempuan_awal')->default(0);
            $table->integer('jumlah_laki_laki_akhir')->default(0);
            $table->integer('jumlah_perempuan_akhir')->default(0);
            $table->integer('jumlah_laki_laki_pindah')->default(0);
            $table->integer('jumlah_perempuan_pindah')->default(0);
            $table->integer('jumlah_laki_laki_datang')->default(0);
            $table->integer('jumlah_perempuan_datang')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_rekapitulasis');
    }
};
