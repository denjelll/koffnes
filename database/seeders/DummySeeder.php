<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummySeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data kategori utama
        DB::table('kategori_utama')->insert([
            ['id_kategoriutama' => 'KT001', 'nama_kategori' => 'Makanan'],
            ['id_kategoriutama' => 'KT002', 'nama_kategori' => 'Minuman'],
            ['id_kategoriutama' => 'KT003', 'nama_kategori' => 'Dessert'],
        ]);

        // Menambahkan data kategori detail
        DB::table('kategori_detail')->insert([
            ['id_kategoridetail' => 'KD001', 'id_kategoriutama' => 'KT001', 'nama_detail' => 'Nasi Goreng'],
            ['id_kategoridetail' => 'KD002', 'id_kategoriutama' => 'KT001', 'nama_detail' => 'Mie Goreng'],
            ['id_kategoridetail' => 'KD003', 'id_kategoriutama' => 'KT002', 'nama_detail' => 'Es Teh'],
            ['id_kategoridetail' => 'KD004', 'id_kategoriutama' => 'KT002', 'nama_detail' => 'Kopi'],
            ['id_kategoridetail' => 'KD005', 'id_kategoriutama' => 'KT003', 'nama_detail' => 'Es Krim'],
        ]);

        // Menambahkan data promo (hanya 1-3 item)
        DB::table('promos')->insert([
            ['id_promo' => 'P001', 'diskon' => 10.00, 'waktu_mulai' => Carbon::now()->subDays(1), 'waktu_berakhir' => Carbon::now()->addDays(7)],
            ['id_promo' => 'P002', 'diskon' => 15.00, 'waktu_mulai' => Carbon::now()->addDays(1), 'waktu_berakhir' => Carbon::now()->addDays(14)],
        ]);

        // Menambahkan data addons
        DB::table('addons')->insert([
            ['id_addons' => 'A001', 'addons_menu' => 'Topping'],
            ['id_addons' => 'A002', 'addons_menu' => 'Tambahan Bumbu'],
        ]);

        // Menambahkan data detail addons
        DB::table('detail_addons')->insert([
            ['id_detailaddons' => 'DA001', 'id_addons' => 'A001', 'detail_addons' => 'Telur Ceplok', 'harga_addons' => 5000],
            ['id_detailaddons' => 'DA002', 'id_addons' => 'A001', 'detail_addons' => 'Keju', 'harga_addons' => 7000],
            ['id_detailaddons' => 'DA003', 'id_addons' => 'A002', 'detail_addons' => 'Sambal Terasi', 'harga_addons' => 2000],
            ['id_detailaddons' => 'DA004', 'id_addons' => 'A002', 'detail_addons' => 'Kecap Manis', 'harga_addons' => 1500],
        ]);

        // Menambahkan data menu (20 item)
        for ($i = 1; $i <= 20; $i++) {
            DB::table('menus')->insert([
                'id_menu' => 'M' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'id_kategoridetail' => 'KD' . str_pad(rand(1, 5), 3, '0', STR_PAD_LEFT), // Random kategori detail
                'id_promo' => rand(1, 3) == 1 ? 'P00' . rand(1, 2) : null, // 1-2 promo secara acak
                'id_addons' => rand(1, 3) == 1 ? 'A00' . rand(1, 2) : null, // 1-2 addons secara acak
                'nama_menu' => 'Menu ' . $i,
                'stock' => rand(10, 50),
                'harga' => rand(15000, 100000),
                'deskripsi' => 'Deskripsi menu ke-' . $i,
                'gambar' => 'menu' . $i . '.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
