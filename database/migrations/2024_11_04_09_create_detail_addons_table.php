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
            $table->string('id_detailaddon', 50)->primary();

            $table->unsignedBigInteger('id_addon'); 
            $table->foreign('id_addon') 
                  ->references('id_addon') 
                  ->on('add_ons') 
                  ->onDelete('cascade') 
                  ->onUpdate('cascade');
            
            $table->string('id_detailorder');
            $table->foreign('id_detailorder')
                ->references('id_detailorder')
                ->on('detail_orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('kuantitas');
            $table->integer('harga');
            $table->timestamp('waktu_transaksi')->useCurrent();
            $table->timestamp('updated_on')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
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
