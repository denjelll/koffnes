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
        Schema::create('events', function (Blueprint $table) {
            $table->string('id_event', 50)->primary();
            $table->string('nama_event', 100);
            $table->string('banner_event', 255); // Path untuk gambar banner
            $table->string('hadiah_event', 100);
            $table->date('tanggal_event');
            $table->time('jam_event');
            $table->text('deskripsi_event');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
