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
        Schema::create('perangkat_desas', function (Blueprint $table) {
            $table->string("id_prDesa");
            $table->string("nama_pd");
            $table->string("jabatan_pd");
            $table->string("pendidikan_pd");
            $table->string("tempat_tanggal_lahir_pd");
            $table->string("agama_pd");
            $table->text("alamat_pd");
            $table->string("url_foto_profil")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_desas');
    }
};
