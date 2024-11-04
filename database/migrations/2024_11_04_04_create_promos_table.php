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
        Schema::create('promos', function (Blueprint $table) {
            $table->string('id_promo', 50)->primary();
            $table->decimal('diskon', 5, 2); // Misalnya 10.50 untuk diskon 10.5%
            $table->datetime('waktu_mulai'); // Menggunakan datetime untuk menyimpan waktu spesifik
            $table->datetime('waktu_berakhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_promos');
    }
};
