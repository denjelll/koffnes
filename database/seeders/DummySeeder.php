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

       //Masukin promo ke menu 1 dan 2
        DB::table('menus')->insert([
            [
                'id_menu' => 1,
                'id_promo' => 1,
                'nama_menu' => 'Menu 1',
                'stock' => rand(10, 50),
                'harga' => rand(15000, 100000),
                'deskripsi' => 'Deskripsi menu ke-1',
                'gambar' => 'menu1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_menu' => 2,
                'id_promo' => 2,
                'nama_menu' => 'Menu 2',
                'stock' => rand(10, 50),
                'harga' => rand(15000, 100000),
                'deskripsi' => 'Deskripsi menu ke-2',
                'gambar' => 'menu2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

         // Menambahkan data menu dengan id_menu auto increment
        for ($i = 3; $i <= 20; $i++) {
            DB::table('menus')->insert([
                'id_menu' => $i,
                'id_promo' => null,
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
        $isiKategoriData = [];
        $categories = [1, 2, 3]; // Sesuaikan kategori yang ada

        // Mengelompokkan 20 menu ke dalam beberapa kategori secara acak
        for ($i = 1; $i <= 20; $i++) {
            $isiKategoriData[] = [
                'id_isi_kategori' => $i,
                'id_kategori' => $categories[array_rand($categories)],
                'id_menu' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('isi_kategoris')->insert($isiKategoriData);


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
