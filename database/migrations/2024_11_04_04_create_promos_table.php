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
            $table->id('id_promo')->autoIncrement();
            $table->string('judul_promo', 50);
            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')->references('id_menu')->on('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('harga_promo'); // Misalnya 10.50 untuk diskon 10.5%
            $table->date('tanggal_mulai'); // Menggunakan datetime untuk menyimpan waktu spesifik
            $table->date('tanggal_berakhir');
            $table->time('waktu_mulai');
            $table->time('waktu_berakhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
