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
        Schema::create('rt_s', function (Blueprint $table) {
            $table->string('id_rt')->primary();
            $table->integer('nomor_rt');
            $table->string('nama_rt');
            $table->string('alamat_rt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rt_s');
    }
};
