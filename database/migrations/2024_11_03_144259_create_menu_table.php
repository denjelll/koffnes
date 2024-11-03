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
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu'); 
            $table->foreignId('id_kategori_detail')
                  ->constrained('kategori_detail') // Menghubungkan ke tabel kategori_detail
                  ->onDelete('cascade')            // Menghapus menu jika kategori detail dihapus
                  ->onUpdate('cascade');           // Update id_kategori_detail jika berubah di tabel kategori_detail
            $table->foreignId('id_promo')
                  ->nullable()                    // Promo bisa kosong jika menu tidak sedang dalam promo
                  ->constrained('promo')          // Menghubungkan ke tabel promo
                  ->onDelete('set null')          // Set null jika promo dihapus
                  ->onUpdate('cascade');          // Update id_promo jika berubah di tabel promo
            $table->string('nama_menu', 50);       // Nama menu dengan panjang maksimal 50 karakter
            $table->integer('stock')->unsigned();  // Stok menu (hanya bilangan positif)
            $table->integer('harga')->unsigned();  // Harga menu dalam bentuk integer (juga bilangan positif)
            $table->text('deskripsi')->nullable(); // Deskripsi menu, optional
            $table->string('gambar', 255);         // Path gambar, maksimal 255 karakter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
