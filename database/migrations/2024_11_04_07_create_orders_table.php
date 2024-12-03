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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id_order', 50)->primary();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users') 
                  ->onDelete('cascade')            
                  ->onUpdate('cascade');

            $table->integer('antrian')->unsigned();
            $table->string('customer', 50);
            $table->tinyInteger('meja')->unsigned()->check('meja >= 1 AND meja <= 21');
            $table->enum('tipe_order', ['Dine In', 'Take Away', 'Delivery']);
            $table->enum('metode_pembayaran', ['EDC', 'Debit', 'Cash'])->nullable();
            $table->enum('status', ['Paid', 'Open Bill', 'Cancelled']);
            $table->integer('bayar')->unsigned();
            $table->integer('kembalian')->unsigned();
            $table->integer('total_harga')->unsigned();
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
        Schema::dropIfExists('orders');
    }
};
