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
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id('id_detailorder')->autoIncrement();

            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')
                  ->references('id_order')
                  ->on('orders')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')
                  ->references('id_menu')
                  ->on('menus')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->integer('kuantitas');
            $table->integer('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};
