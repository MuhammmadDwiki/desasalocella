<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('rekapitulasi_r_t_s', function (Blueprint $table) {
    //         // Remove default value from status column
    //         // This allows application logic to control the status
    //         $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default(null)->change();
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::table('rekapitulasi_r_t_s', function (Blueprint $table) {
    //         // Restore default value
    //         $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft')->change();
    //     });
    // }
};
