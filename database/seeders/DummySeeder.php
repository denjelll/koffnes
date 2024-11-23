<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummySeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id_user' => '12345678',
            'nama_depan' => 'Admin',
            'nama_belakang' => 'Rokbar',
            'no_telepon' => '0812345678',
            'email' => 'qwe@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // Menambahkan data kategori
        DB::table('kategoris')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Breakfast', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_kategori' => 2, 'nama_kategori' => 'Minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_kategori' => 3, 'nama_kategori' => 'Rokbar Series', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_kategori' => 4, 'nama_kategori' => 'Bundling', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
                'id_promo' => ($i <= 2 ? $i : null),
                'nama_menu' => 'Menu ' . $i,
                'stock' => rand(10, 50),
                'harga' => rand(15000, 100000),
                'deskripsi' => 'Deskripsi menu ke-' . $i,
                'gambar' => 'menu' . $i . '.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Menambahkan menu bundling ke menu
        for ($i = 21; $i <= 25; $i++) {
            DB::table('menus')->insert([
                'id_menu' => $i,
                'id_promo' => null,
                'nama_menu' => 'Menu Bundling ' . $i,
                'stock' => rand(10, 50),
                'harga' => rand(15000, 100000),
                'deskripsi' => 'Deskripsi menu bundling ke-' . $i,
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

        // Menambahkan data order
        for ($i = 1; $i <= 10; $i++) {
            $id_order = 'ORD' . Str::random(10) . $i;
            DB::table('orders')->insert([
                'id_order' => $id_order,
                'id_user' => '99999999',
                'antrian' => $i,
                'customer' => 'Customer ' . $i,
                'meja' => rand(1, 21),
                'tipe_order' => 'Dine In',
                'status' => ['Paid', 'Open Bill', 'Cancelled'][array_rand(['Paid', 'Open Bill', 'Cancelled'])],
                'total_harga' => rand(100000, 500000),
                'waktu_transaksi' => Carbon::now(),
                'updated_on' => Carbon::now(),
                'deleted_at' => null,
            ]);

            // Menambahkan data detail order
            for ($j = 1; $j <= 2; $j++) { // Misal setiap order punya 2 detail order
                $id_detailorder = 'DORD' . Str::random(10) . $j;
                DB::table('detail_orders')->insert([
                    'id_detailorder' => $id_detailorder,
                    'id_order' => $id_order,
                    'id_menu' => rand(1, 20),
                    'kuantitas' => rand(1, 5),
                    'harga_menu' => rand(15000, 100000),
                    'notes' => 'Notes for menu ' . $i . '-' . $j,
                    'waktu_transaksi' => Carbon::now(),
                    'updated_on' => Carbon::now(),
                    'deleted_at' => null,
                ]);

                // Menambahkan data detail addon
                for ($k = 1; $k <= 2; $k++) { // Misal setiap detail order punya 2 detail addon
                    $id_detailaddon = 'DADD' . Str::random(3) . $k;
                    DB::table('detail_addons')->insert([
                        'id_detailaddon' => $id_detailaddon,
                        'id_addon' => rand(1, 4),
                        'id_detailorder' => $id_detailorder,
                        'kuantitas' => rand(1, 5),
                        'harga' => rand(2000, 7000),
                        'waktu_transaksi' => Carbon::now(),
                        'updated_on' => Carbon::now(),
                        'deleted_at' => null,
                    ]);
                }
            }
        }
    }
}
