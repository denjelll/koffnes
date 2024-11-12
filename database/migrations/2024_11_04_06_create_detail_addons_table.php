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
            $table->string('id_detailaddons', 10)->primary();

            $table->string('id_addons', 10);
            $table->foreign('id_addons')
                  ->references('id_addons')
                  ->on('addons')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->string('detail_addons', 50);
            $table->integer('harga_addons');
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
