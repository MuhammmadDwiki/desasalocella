<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // this is refactor table for rekapitulasi_penduduks and detail rekapitulasi table

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekapitulasi_r_t_s', function (Blueprint $table) {
            $table->string('id_rekap_rt')->primary();
            $table->string('id_rekap');
            $table->string('id_rt');
            $table->integer('jumlah_kk')->default(0);
            $table->integer('jumlah_penduduk_akhir')->default(0);
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->text('catatan_validasi')->nullable();
            $table->foreignId('submitted_by')->constrained('users');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi_r_t_s');
    }
};
