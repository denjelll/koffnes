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
        Schema::create('detail_addons', function (Blueprint $table) {
            $table->string('id_detailaddon', 10)->primary();

            $table->string('id_addon', 10);
            $table->foreign('id_addon')
                  ->references('id_addon')
                  ->on('addons')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->string('id_detailorder', 50);
            $table->foreign('id_detailorder')
                ->references('id_detailorder')
                ->on('detail_orders')
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
        Schema::dropIfExists('detail_addons');
    }
};
