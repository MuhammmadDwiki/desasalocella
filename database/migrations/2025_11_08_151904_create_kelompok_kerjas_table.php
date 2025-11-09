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
        Schema::create('kelompok_kerjas', function (Blueprint $table) {
            $table->id('id_kelompok_kerja');
            $table->string('nama_kelompok_kerja');
            $table->timestamps();
        });
         
        Schema::table('pkks', function (Blueprint $table) {
            $table->string('kelompok_kerja')->nullable()->after('jabatan_pkk');
        });
    }

    /**
     * Reverse the migrations.
     */
      public function down(): void
    {
        Schema::table('pkks', function (Blueprint $table) {
            $table->dropColumn('kelompok_kerja');
        });
        
        Schema::dropIfExists('kelompok_kerjas');
    }
};
