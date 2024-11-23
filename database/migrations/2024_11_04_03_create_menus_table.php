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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu')->autoIncrement();
            $table->unsignedBigInteger('id_promo')->nullable();
            $table->foreign('id_promo')->references('id_promo')->on('promos')->onDelete('set null')->onUpdate('cascade');
            $table->string('nama_menu', 50);
            $table->integer('stock')->unsigned();
            $table->integer('harga')->unsigned();
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
