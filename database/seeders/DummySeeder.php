<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummySeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data kategori
        DB::table('kategori')->insert([
            ['id_kategori' => 'KT001', 'nama_kategori' => 'Breakfast'],
            ['id_kategori' => 'KT002', 'nama_kategori' => 'Minuman'],
            ['id_kategori' => 'KT003', 'nama_kategori' => 'Rokbar Series'],
        ]);

        // Menambahkan data promo
        DB::table('promos')->insert([
            ['id_promo' => 'P001', 'diskon' => 10.00, 'waktu_mulai' => Carbon::now()->subDays(1), 'waktu_berakhir' => Carbon::now()->addDays(7)],
            ['id_promo' => 'P002', 'diskon' => 15.00, 'waktu_mulai' => Carbon::now()->addDays(1), 'waktu_berakhir' => Carbon::now()->addDays(14)],
        ]);

        // Menambahkan data addon
        DB::table('addons')->insert([
            ['id_addon' => 'A001', 'nama_addon' => 'Telur Ceplok', 'harga' => 5000],
            ['id_addon' => 'A002', 'nama_addon' => 'Keju', 'harga' => 7000],
            ['id_addon' => 'A003', 'nama_addon' => 'Sambal Terasi', 'harga' => 2000],
            ['id_addon' => 'A004', 'nama_addon' => 'Kecap Manis', 'harga' => 1500],
        ]);

        // Menambahkan data menu
        for ($i = 1; $i <= 20; $i++) {
            DB::table('menus')->insert([
                'id_menu' => 'M' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'id_kategori' => 'KT' . str_pad(rand(1, 3), 3, '0', STR_PAD_LEFT),
                'id_promo' => rand(1, 3) == 1 ? 'P00' . rand(1, 2) : null,
                'nama_menu' => 'Menu ' . $i,
                'stock' => rand(10, 50),
                'harga' => rand(15000, 100000),
                'deskripsi' => 'Deskripsi menu ke-' . $i,
                'gambar' => 'menu' . $i . '.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Menambahkan data paket addon setelah menu telah ditambahkan
        DB::table('paket_addons')->insert([
            ['id_paketaddon' => 'PA001', 'id_menu' => 'M020', 'id_addon' => 'A001'],
            ['id_paketaddon' => 'PA002', 'id_menu' => 'M020', 'id_addon' => 'A002'],
            ['id_paketaddon' => 'PA003', 'id_menu' => 'M017', 'id_addon' => 'A003'],
            ['id_paketaddon' => 'PA004', 'id_menu' => 'M003', 'id_addon' => 'A004'],
        ]);

        // Menambahkan data user dengan id_user 'NOT PICK UP'
        DB::table('users')->insert([
            'id_user' => 'NOT_PICK_UP',
            'nama_depan' => 'Not',
            'nama_belakang' => 'Pick Up',
            'no_telepon' => '0000000000',
            'email' => 'notpickup@example.com',
            'password' => bcrypt('password'),
            'role' => 'Kasir'
        ]);
    }
}
