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
        DB::table('kategoris')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Breakfast', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_kategori' => 2, 'nama_kategori' => 'Minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_kategori' => 3, 'nama_kategori' => 'Rokbar Series', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Menambahkan data promo
        DB::table('promos')->insert([
            [
                'id_promo' => 1,
                'judul_promo' => 'Diskon Pagi',
                'harga_promo' => 5000,
                'hari' => 'AllDay',
                'waktu_mulai' => '06:00:00',
                'waktu_berakhir' => '10:00:00',
                'status' => 'Aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_promo' => 2,
                'judul_promo' => 'Diskon Siang',
                'harga_promo' => 10000,
                'hari' => 'AllDay',
                'waktu_mulai' => '12:00:00',
                'waktu_berakhir' => '14:00:00',
                'status' => 'Aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Menambahkan data menu dengan id_menu auto increment
        for ($i = 1; $i <= 20; $i++) {
            DB::table('menus')->insert([
                'id_menu' => $i,
                'id_promo' => rand(1, 3) == 1 ? rand(1, 2) : null,
                'nama_menu' => 'Menu ' . $i,
                'stock' => rand(10, 50),
                'harga' => rand(15000, 100000),
                'deskripsi' => 'Deskripsi menu ke-' . $i,
                'gambar' => 'menu' . $i . '.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Menambahkan data addon
        DB::table('add_ons')->insert([
            ['id_addon' => 1, 'nama_addon' => 'Telur Ceplok', 'harga' => 5000, 'id_menu' => 1],
            ['id_addon' => 2, 'nama_addon' => 'Keju', 'harga' => 7000, 'id_menu' => 1],
            ['id_addon' => 3, 'nama_addon' => 'Sambal Terasi', 'harga' => 2000, 'id_menu' => 2],
            ['id_addon' => 4, 'nama_addon' => 'Kecap Manis', 'harga' => 1500, 'id_menu' => 2],
        ]);

        // Menambahkan data untuk relasi kategori dan menu
        DB::table('isi_kategoris')->insert([
            ['id_isi_kategori' => 1, 'id_kategori' => 1, 'id_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_isi_kategori' => 2, 'id_kategori' => 1, 'id_menu' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_isi_kategori' => 3, 'id_kategori' => 2, 'id_menu' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);

        // Menambahkan data user dengan id_user 'NOT_PICK_UP'
        DB::table('users')->insert([
            'id_user' => '99999999',
            'nama_depan' => 'Not',
            'nama_belakang' => 'Pick Up',
            'no_telepon' => '0000000000',
            'email' => 'notpickup@example.com',
            'password' => bcrypt('password'),
            'role' => 'Kasir',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
