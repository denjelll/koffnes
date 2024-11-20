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
