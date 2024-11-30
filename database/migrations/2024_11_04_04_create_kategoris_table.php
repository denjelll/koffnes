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
<<<<<<<< HEAD:database/migrations/2024_11_04_02_create_kategori_utama_table.php
        Schema::create('kategori_utama', function (Blueprint $table) {
            $table->id('id_kategoriutama')->autoIncrement();
            $table->string('nama_kategori', 50);
========

        Schema::create('kategoris', function (Blueprint $table) {
            $table->id('id_kategori')->autoIncrement();
            $table->string('nama_kategori', 50);
            $table->timestamps();
>>>>>>>> main:database/migrations/2024_11_04_04_create_kategoris_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2024_11_04_02_create_kategori_utama_table.php
        Schema::dropIfExists('kategori_utama');
========
        Schema::dropIfExists('kategoris');
>>>>>>>> main:database/migrations/2024_11_04_04_create_kategoris_table.php
    }
};
