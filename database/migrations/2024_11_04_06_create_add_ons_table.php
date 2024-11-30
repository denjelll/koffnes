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
<<<<<<< HEAD:database/migrations/2024_11_04_05_create_addons_table.php
        Schema::create('addons', function (Blueprint $table) {
            $table->id('id_addons')->autoIncrement();
            $table->string('addons_menu', 50);
=======
        Schema::create('add_ons', function (Blueprint $table) {
            $table->id('id_addon')->autoIncrement();
            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')
                  ->references('id_menu')
                  ->on('menus')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('nama_addon', 50);
            $table->integer('harga');
>>>>>>> main:database/migrations/2024_11_04_06_create_add_ons_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_ons');
    }
};
