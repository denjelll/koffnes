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
        Schema::create('isi_kategoris', function (Blueprint $table) {
            $table->id('id_isi_kategori')->autoIncrement();
            
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategoris')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')
                  ->references('id_menu')
                  ->on('menus')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_kategoris');
    }
};
