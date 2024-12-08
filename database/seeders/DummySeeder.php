<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    public function run()
    {
         // Insert waktu buka/tutup
        DB::table('koffnes_statuses')->insert([
            'status_koffnes' => 'open',
        ]);

        //Dummy Events
        DB::table('events')->insert([
            [
                'id_event' => 1,
                'nama_event' => 'Festival Musim Panas',
                'banner_event' => 'event/banner1.jpg',
                'hadiah_event' => 'Hadiah Utama: Liburan ke Bali',
                'tanggal_event' => Carbon::create(2023, 6, 21),
                'jam_event' => Carbon::createFromTime(18, 0, 0),
                'deskripsi_event' => 'Festival Musim Panas terbesar tahun ini dengan berbagai kegiatan menarik dan hadiah besar.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_event' => 2,
                'nama_event' => 'Lomba Makan Burger',
                'banner_event' => 'event/banner2.jpg',
                'hadiah_event' => 'Voucher Makan Gratis Selama Setahun',
                'tanggal_event' => Carbon::create(2023, 7, 4),
                'jam_event' => Carbon::createFromTime(12, 0, 0),
                'deskripsi_event' => 'Lomba makan burger cepat dengan berbagai hadiah menarik.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_event' => 3,
                'nama_event' => 'Marathon Amal',
                'banner_event' => 'event/banner3.jpg',
                'hadiah_event' => 'Medali Emas dan Donasi ke Yayasan',
                'tanggal_event' => Carbon::create(2023, 9, 10),
                'jam_event' => Carbon::createFromTime(6, 0, 0),
                'deskripsi_event' => 'Marathon untuk amal dengan tujuan mengumpulkan donasi untuk yayasan yang membutuhkan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);

        $menus = [
            ['id_menu' => 1, 'id_promo' => null, 'nama_menu' => 'Mix Platter', 'stock' => 50, 'harga' => 55000, 'deskripsi' => 'Combo snack platter lezat.', 'gambar' => 'Mix Platter.webp'],
            ['id_menu' => 2, 'id_promo' => null, 'nama_menu' => 'Sosis Bakar', 'stock' => 100, 'harga' => 22000, 'deskripsi' => 'Sosis panggang dengan saus spesial.', 'gambar' => 'Sosis Bakar.webp'],
            ['id_menu' => 3, 'id_promo' => null, 'nama_menu' => 'Roti Panggang', 'stock' => 80, 'harga' => 15000, 'deskripsi' => 'Roti dengan topping manis dan gurih.', 'gambar' => 'Roti Panggang.webp'],
            ['id_menu' => 4, 'id_promo' => null, 'nama_menu' => 'Tteokbokki', 'stock' => 60, 'harga' => 28000, 'deskripsi' => 'Kue beras pedas ala Korea.', 'gambar' => 'Tteokbokki.webp'],
            ['id_menu' => 5, 'id_promo' => null, 'nama_menu' => 'Pancake', 'stock' => 70, 'harga' => 15000, 'deskripsi' => 'Pancake lembut dengan topping.', 'gambar' => 'Pancake.webp'],
            ['id_menu' => 6, 'id_promo' => null, 'nama_menu' => 'French Fries', 'stock' => 120, 'harga' => 18000, 'deskripsi' => 'Kentang goreng renyah.', 'gambar' => 'French Fries.webp'],
            ['id_menu' => 7, 'id_promo' => null, 'nama_menu' => 'Pisang Goreng', 'stock' => 90, 'harga' => 16000, 'deskripsi' => 'Pisang goreng tradisional.', 'gambar' => 'Pisang Goreng.webp'],
            ['id_menu' => 8, 'id_promo' => null, 'nama_menu' => 'Pisang Goreng Coklat Keju', 'stock' => 100, 'harga' => 18000, 'deskripsi' => 'Pisang goreng dengan topping coklat dan keju.', 'gambar' => 'Pisang Goreng Coklat Keju.webp'],
            ['id_menu' => 9, 'id_promo' => null, 'nama_menu' => 'Dimsum', 'stock' => 80, 'harga' => 18000, 'deskripsi' => 'Dimsum kukus dengan saus.', 'gambar' => 'Dimsum.webp'],
            ['id_menu' => 10, 'id_promo' => null, 'nama_menu' => 'Brownies', 'stock' => 70, 'harga' => 25000, 'deskripsi' => 'Brownies coklat moist.', 'gambar' => 'Brownies.webp'],
            ['id_menu' => 11, 'id_promo' => null, 'nama_menu' => 'Cireng', 'stock' => 90, 'harga' => 18000, 'deskripsi' => 'Aci digoreng dengan bumbu spesial.', 'gambar' => 'Cireng.webp'],
            ['id_menu' => 12, 'id_promo' => null, 'nama_menu' => 'Churros', 'stock' => 100, 'harga' => 18000, 'deskripsi' => 'Churros dengan saus coklat.', 'gambar' => 'Churros.webp'],
            ['id_menu' => 13, 'id_promo' => null, 'nama_menu' => 'Chicken Curry Rice', 'stock' => 30, 'harga' => 32000, 'deskripsi' => 'Nasi dengan kari ayam lezat.', 'gambar' => 'Chicken Curry Rice.webp'],
            ['id_menu' => 14, 'id_promo' => null, 'nama_menu' => 'Gyudon (Beef Teriyaki)', 'stock' => 80, 'harga' => 34000, 'deskripsi' => 'Nasi dengan daging sapi teriyaki.', 'gambar' => 'Gyudon (Beef Teriyaki).webp'],
            ['id_menu' => 15, 'id_promo' => null, 'nama_menu' => 'Nasi Goreng Kampung', 'stock' => 90, 'harga' => 22000, 'deskripsi' => 'Nasi goreng tradisional.', 'gambar' => 'Nasi Goreng Kampung.webp'],
            ['id_menu' => 16, 'id_promo' => null, 'nama_menu' => 'Nasi Goreng Katsu', 'stock' => 60, 'harga' => 30000, 'deskripsi' => 'Nasi goreng dengan ayam katsu.', 'gambar' => 'Nasi Goreng Katsu.webp'],
            ['id_menu' => 17, 'id_promo' => null, 'nama_menu' => 'Nasi Telur Pontianak', 'stock' => 90, 'harga' => 20000, 'deskripsi' => 'Nasi dengan telur khas pontianak.', 'gambar' => 'Nasi Telur Pontianak.webp'],
            ['id_menu' => 18, 'id_promo' => null, 'nama_menu' => 'Chicken Katsu Rice', 'stock' => 80, 'harga' => 22000, 'deskripsi' => 'Nasi dengan ayam katsu renyah.', 'gambar' => 'Chicken Katsu Rice.webp'],
            ['id_menu' => 19, 'id_promo' => null, 'nama_menu' => 'Honey Sauce Chicken Rice', 'stock' => 60, 'harga' => 22000, 'deskripsi' => 'Nasi dengan ayam saus madu.', 'gambar' => 'Honey Sauce Chicken Rice.webp'],
            ['id_menu' => 20, 'id_promo' => null, 'nama_menu' => 'Fire Chicken Rice', 'stock' => 50, 'harga' => 22000, 'deskripsi' => 'Nasi dengan ayam pedas spesial.', 'gambar' => 'Fire Chicken Rice.webp'],
            ['id_menu' => 21, 'id_promo' => null, 'nama_menu' => 'Chicken Nanban', 'stock' => 100, 'harga' => 22000, 'deskripsi' => 'Nasi dengan ayam nanban khas Jepang.', 'gambar' => 'Chicken Nanban.webp'],
            ['id_menu' => 22, 'id_promo' => null, 'nama_menu' => 'Chicken Creamy Mushroom', 'stock' => 100, 'harga' => 32000, 'deskripsi' => 'Kentang dengan ayam saus jamur crispy.', 'gambar' => 'Chicken Creamy Mushroom.webp'],
            ['id_menu' => 23, 'id_promo' => null, 'nama_menu' => 'Chicken Cordon Bleu', 'stock' => 80, 'harga' => 34000, 'deskripsi' => 'Ayam isi keju dan ham goreng.', 'gambar' => 'Chicken Cordon Bleu.webp'],
            ['id_menu' => 24, 'id_promo' => null, 'nama_menu' => 'Chicken Steak', 'stock' => 80, 'harga' => 32000, 'deskripsi' => 'Steak ayam dengan saus pilihan.', 'gambar' => 'Chicken Steak.webp'],
            ['id_menu' => 25, 'id_promo' => null, 'nama_menu' => 'Mac & Cheese', 'stock' => 70, 'harga' => 22000, 'deskripsi' => 'Pasta dengan keju creamy.', 'gambar' => 'Mac & Cheese.webp'],
            ['id_menu' => 26, 'id_promo' => null, 'nama_menu' => 'Creamy Chicken Spaghetti', 'stock' => 20, 'harga' => 24000, 'deskripsi' => 'Spaghetti dengan ayam creamy.', 'gambar' => 'Creamy Chicken Spaghetti.webp'],
            ['id_menu' => 27, 'id_promo' => null, 'nama_menu' => 'Spaghetti Aglio Olio', 'stock' => 30, 'harga' => 22000, 'deskripsi' => 'Spaghetti dengan minyak zaitun dan bawang.', 'gambar' => 'Spaghetti Aglio Olio.webp'],
            ['id_menu' => 28, 'id_promo' => null, 'nama_menu' => 'Indomie Goreng', 'stock' => 100, 'harga' => 15000, 'deskripsi' => 'Indomie goreng klasik.', 'gambar' => 'Indomie Goreng.webp'],
            ['id_menu' => 29, 'id_promo' => null, 'nama_menu' => 'Indomie Kari Ayam', 'stock' => 70, 'harga' => 15000, 'deskripsi' => 'Indomie kuah kari ayam.', 'gambar' => 'Indomie Kari Ayam.webp'],
            ['id_menu' => 30, 'id_promo' => null, 'nama_menu' => 'Indomie Ayam Bawang', 'stock' => 70, 'harga' => 15000, 'deskripsi' => 'Indomie kuah ayam bawang.', 'gambar' => 'Indomie Ayam Bawang.webp'],
            ['id_menu' => 31, 'id_promo' => null, 'nama_menu' => 'Indomie Rawon Pedas', 'stock' => 50, 'harga' => 15000, 'deskripsi' => 'Indomie kuah rawon pedas.', 'gambar' => 'Indomie Rawon Pedas.webp'],
            ['id_menu' => 32, 'id_promo' => null, 'nama_menu' => 'Indomie Goreng Aceh', 'stock' => 30, 'harga' => 15000, 'deskripsi' => 'Indomie goreng khas Aceh.', 'gambar' => 'Indomie Goreng Aceh.webp'],
            ['id_menu' => 33, 'id_promo' => null, 'nama_menu' => 'Indomie Goreng Rendang', 'stock' => 90, 'harga' => 15000, 'deskripsi' => 'Indomie goreng rendang.', 'gambar' => 'Indomie Goreng Rendang.webp'],
            ['id_menu' => 34, 'id_promo' => null, 'nama_menu' => 'Best Wok Mie Goreng', 'stock' => 80, 'harga' => 15000, 'deskripsi' => 'Mie goreng spesial.', 'gambar' => 'Best Wok Mie Goreng.webp'],
            ['id_menu' => 35, 'id_promo' => null, 'nama_menu' => 'Mie Sedaap Singapore Spicy Laksa', 'stock' => 70, 'harga' => 15000, 'deskripsi' => 'Mie laksa pedas khas Singapura.', 'gambar' => 'Mie Sedaap Singapore Spicy Laksa.webp'],
            ['id_menu' => 36, 'id_promo' => null, 'nama_menu' => 'Mie Sedaap Korean Spicy Chicken', 'stock' => 40, 'harga' => 15000, 'deskripsi' => 'Mie ayam pedas Korea.', 'gambar' => 'Mie Sedaap Korean Spicy Chicken.webp'],
            ['id_menu' => 37, 'id_promo' => null, 'nama_menu' => 'Indomie Soto Banjar Limau Kuit', 'stock' => 90, 'harga' => 15000, 'deskripsi' => 'Mie kuah soto khas Banjar.', 'gambar' => 'Indomie Soto Banjar Limau Kuit.webp'],
            ['id_menu' => 38, 'id_promo' => null, 'nama_menu' => 'Mie Sedaap White Curry', 'stock' => 100, 'harga' => 15000, 'deskripsi' => 'Mie kuah kari putih.', 'gambar' => 'Mie Sedaap White Curry.webp'],
            ['id_menu' => 39, 'id_promo' => null, 'nama_menu' => 'Nessy Coffee', 'stock' => 100, 'harga' => 20000, 'deskripsi' => 'Kopi khas Nessy.', 'gambar' => 'Nessy Coffee.webp'],
            ['id_menu' => 40, 'id_promo' => null, 'nama_menu' => 'Matcha Coffee', 'stock' => 50, 'harga' => 24000, 'deskripsi' => 'Kopi matcha dengan matcha premium.', 'gambar' => 'Matcha Coffee.webp'],
            ['id_menu' => 41, 'id_promo' => null, 'nama_menu' => 'Pandan Coffee', 'stock' => 100, 'harga' => 22000, 'deskripsi' => 'Kopi dengan aroma pandan.', 'gambar' => 'Pandan Coffee.webp'],
            ['id_menu' => 42, 'id_promo' => null, 'nama_menu' => 'Coconut Island Coffee', 'stock' => 60, 'harga' => 22000, 'deskripsi' => 'Kopi kelapa spesial.', 'gambar' => 'Coconut Island Coffee.webp'],
            ['id_menu' => 43, 'id_promo' => null, 'nama_menu' => 'Raspberry Blush Coffee', 'stock' => 80, 'harga' => 22000, 'deskripsi' => 'Kopi rasa raspberry.', 'gambar' => 'Raspberry Blush Coffee.webp'],
            ['id_menu' => 44, 'id_promo' => null, 'nama_menu' => 'Vanilla Coffee', 'stock' => 30, 'harga' => 22000, 'deskripsi' => 'Kopi dengan vanilla.', 'gambar' => 'Vanilla Coffee.webp'],
            ['id_menu' => 45, 'id_promo' => null, 'nama_menu' => 'Hazelnut Coffee', 'stock' => 90, 'harga' => 22000, 'deskripsi' => 'Kopi dengan hazelnut.', 'gambar' => 'Hazelnut Coffee.webp'],
            ['id_menu' => 46, 'id_promo' => null, 'nama_menu' => 'Affogato', 'stock' => 80, 'harga' => 20000, 'deskripsi' => 'Es krim dengan espresso.', 'gambar' => 'Affogato.webp'],
            ['id_menu' => 47, 'id_promo' => null, 'nama_menu' => 'Iced Latte', 'stock' => 70, 'harga' => 20000, 'deskripsi' => 'Kopi latte dingin.', 'gambar' => 'Iced Latte.webp'],
            ['id_menu' => 48, 'id_promo' => null, 'nama_menu' => 'Caffe Latte', 'stock' => 100, 'harga' => 22000, 'deskripsi' => 'Kopi susu klasik.', 'gambar' => 'Caffe Latte.webp'],
            ['id_menu' => 49, 'id_promo' => null, 'nama_menu' => 'Americano', 'stock' => 60, 'harga' => 20000, 'deskripsi' => 'Kopi hitam tanpa gula.', 'gambar' => 'Americano.webp'],
            ['id_menu' => 50, 'id_promo' => null, 'nama_menu' => 'Vietnam Drip', 'stock' => 30, 'harga' => 20000, 'deskripsi' => 'Kopi Vietnam Otentik.', 'gambar' => 'Vietnam Drip.webp'],
            ['id_menu' => 51, 'id_promo' => null, 'nama_menu' => 'V60', 'stock' => 60, 'harga' => 22000, 'deskripsi' => 'Kopi V60 manual brew.', 'gambar' => 'V60.webp'],
            ['id_menu' => 52, 'id_promo' => null, 'nama_menu' => 'Espresso', 'stock' => 50, 'harga' => 12000, 'deskripsi' => 'Kopi shot pekat.', 'gambar' => 'Espresso.webp'],
            ['id_menu' => 53, 'id_promo' => null, 'nama_menu' => 'Matcha Latte', 'stock' => 30, 'harga' => 22000, 'deskripsi' => 'Matcha dengan susu lembut.', 'gambar' => 'Matcha Latte.webp'],
            ['id_menu' => 54, 'id_promo' => null, 'nama_menu' => 'Ice Blue Matcha', 'stock' => 40, 'harga' => 22000, 'deskripsi' => 'matcha dingin biru.', 'gambar' => 'Ice Blue Matcha.webp'],
            ['id_menu' => 55, 'id_promo' => null, 'nama_menu' => 'Iced Tea', 'stock' => 60, 'harga' => 17000, 'deskripsi' => 'Teh dingin klasik.', 'gambar' => 'Iced Tea.webp'],
            ['id_menu' => 56, 'id_promo' => null, 'nama_menu' => 'Lemon Tea', 'stock' => 40, 'harga' => 17000, 'deskripsi' => 'Teh dengan lemon segar.', 'gambar' => 'Lemon Tea.webp'],
            ['id_menu' => 57, 'id_promo' => null, 'nama_menu' => 'Thai Tea', 'stock' => 90, 'harga' => 17000, 'deskripsi' => 'Teh Thailand otentik.', 'gambar' => 'Thai Tea.webp'],
            ['id_menu' => 58, 'id_promo' => null, 'nama_menu' => 'Cinema Tea', 'stock' => 50, 'harga' => 17000, 'deskripsi' => 'Teh manis khas bioskop.', 'gambar' => 'Cinema Tea.webp'],
            ['id_menu' => 59, 'id_promo' => null, 'nama_menu' => 'Lychee Tea', 'stock' => 60, 'harga' => 17000, 'deskripsi' => 'Teh dengan leci.', 'gambar' => 'Lychee Tea.webp'],
            ['id_menu' => 60, 'id_promo' => null, 'nama_menu' => 'Butterfly Pea Lemon Tea', 'stock' => 100, 'harga' => 18000, 'deskripsi' => 'Teh bunga telang lemon.', 'gambar' => 'Butterfly Pea Lemon Tea.webp'],
            ['id_menu' => 61, 'id_promo' => null, 'nama_menu' => 'Nessy Tea', 'stock' => 80, 'harga' => 18000, 'deskripsi' => 'Teh khas Nessy.', 'gambar' => 'Nessy Tea.webp'],
            ['id_menu' => 62, 'id_promo' => null, 'nama_menu' => 'Soda Gembira', 'stock' => 60, 'harga' => 20000, 'deskripsi' => 'Minuman soda segar.', 'gambar' => 'Soda Gembira.webp'],
            ['id_menu' => 63, 'id_promo' => null, 'nama_menu' => 'Berry Float', 'stock' => 80, 'harga' => 22000, 'deskripsi' => 'Minuman float dengan berry.', 'gambar' => 'Berry Float.webp'],
            ['id_menu' => 64, 'id_promo' => null, 'nama_menu' => 'Berryness', 'stock' => 100, 'harga' => 20000, 'deskripsi' => 'Mocktail berry spesial.', 'gambar' => 'Berryness.webp'],
            ['id_menu' => 65, 'id_promo' => null, 'nama_menu' => 'Lemon Float', 'stock' => 70, 'harga' => 22000, 'deskripsi' => 'Float lemon segar.', 'gambar' => 'Lemon Float.webp'],
            ['id_menu' => 66, 'id_promo' => null, 'nama_menu' => 'Lemonness', 'stock' => 20, 'harga' => 20000, 'deskripsi' => 'Mocktail dengan lemon segar.', 'gambar' => 'Lemonness.webp'],
            ['id_menu' => 67, 'id_promo' => null, 'nama_menu' => 'Yakult Berry', 'stock' => 90, 'harga' => 22000, 'deskripsi' => 'Yakult dengan berry.', 'gambar' => 'Yakult Berry.webp'],
            ['id_menu' => 68, 'id_promo' => null, 'nama_menu' => 'Yakult Lemon', 'stock' => 40, 'harga' => 22000, 'deskripsi' => 'Yakult dengan lemon.', 'gambar' => 'Yakult Lemon.webp'],
            ['id_menu' => 69, 'id_promo' => null, 'nama_menu' => 'Red Velvet', 'stock' => 50, 'harga' => 22000, 'deskripsi' => 'Milkshake red velvet.', 'gambar' => 'Red Velvet.webp'],
            ['id_menu' => 70, 'id_promo' => null, 'nama_menu' => 'Taro', 'stock' => 100, 'harga' => 22000, 'deskripsi' => 'Milkshake taro.', 'gambar' => 'Taro.webp'],
            ['id_menu' => 71, 'id_promo' => null, 'nama_menu' => 'Chocolate', 'stock' => 80, 'harga' => 22000, 'deskripsi' => 'Milkshake Coklat.', 'gambar' => 'Chocolate.webp'],
            ['id_menu' => 72, 'id_promo' => null, 'nama_menu' => 'Hazelnut Chocolate', 'stock' => 70, 'harga' => 22000, 'deskripsi' => 'Milkshake hazelnut coklat.', 'gambar' => 'Hazelnut Chocolate.webp'],
            ['id_menu' => 73, 'id_promo' => null, 'nama_menu' => 'Cookies & Cream', 'stock' => 60, 'harga' => 22000, 'deskripsi' => 'Milkshake cookies & cream.', 'gambar' => 'Cookies & Cream.webp'],
            ['id_menu' => 74, 'id_promo' => null, 'nama_menu' => 'Mango', 'stock' => 50, 'harga' => 22000, 'deskripsi' => 'Milkshake rasa mangga.', 'gambar' => 'Mango.webp'],
            ['id_menu' => 75, 'id_promo' => null, 'nama_menu' => 'Milo Dinosaur', 'stock' => 100, 'harga' => 20000, 'deskripsi' => 'Milo dengan taburan coklat.', 'gambar' => 'Milo Dinosaur.webp'],
            ['id_menu' => 76, 'id_promo' => null, 'nama_menu' => 'Hot Chocolate', 'stock' => 70, 'harga' => 22000, 'deskripsi' => 'Coklat panas spesial.', 'gambar' => 'Hot Chocolate.webp'],
            ['id_menu' => 77, 'id_promo' => null, 'nama_menu' => 'Mineral Water', 'stock' => 150, 'harga' => 8000, 'deskripsi' => 'Air mineral segar.', 'gambar' => 'Mineral Water.webp'],
        ];



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
        foreach ($menus as $menu) {
            $i = DB::table('menus')->max('id_menu') + 1;
            DB::table('menus')->insert([
                'id_menu' => $i,
                'id_promo' => $menu['id_promo'],
                'nama_menu' => $menu['nama_menu'],
                'stock' => $menu['stock'],
                'harga' => $menu['harga'],
                'deskripsi' => $menu['deskripsi'],
                'gambar' => $menu['gambar'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }

        // //Menambahkan menu bundling ke menu
        // for ($i = 26; $i <= 25; $i++) {
        //     DB::table('menus')->insert([
        //         'id_menu' => $i,
        //         'id_promo' => null,
        //         'nama_menu' => 'Menu Bundling ' . $i,
        //         'stock' => rand(10, 50),
        //         'harga' => rand(15000, 100000),
        //         'deskripsi' => 'Deskripsi menu bundling ke-' . $i,
        //         'gambar' => 'menu' . $i . '.jpg',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // Menambahkan data addon
        DB::table('add_ons')->insert([
            ['id_addon' => 1, 'nama_addon' => 'Telur Ceplok', 'harga' => 5000, 'id_menu' => 1],
            ['id_addon' => 2, 'nama_addon' => 'Keju', 'harga' => 7000, 'id_menu' => 1],
            ['id_addon' => 3, 'nama_addon' => 'Sambal Terasi', 'harga' => 2000, 'id_menu' => 2],
            ['id_addon' => 4, 'nama_addon' => 'Kecap Manis', 'harga' => 1500, 'id_menu' => 2],
        ]);

        // Menambahkan data user dengan id_user 'NOT_PICK_UP'
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'nama_depan' => 'Not',
                'nama_belakang' => 'Pick Up',
                'no_telepon' => '0000000000',
                'email' => 'notpickup@example.com',
                'password' => bcrypt('password'),
                'role' => 'Kasir',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 2,
                'nama_depan' => 'Admin',
                'nama_belakang' => 'Rokbar',
                'no_telepon' => '0812345678',
                'email' => 'qwe@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 3,
                'nama_depan' => 'Jamal',
                'nama_belakang' => 'Cashier',
                'no_telepon' => '1',
                'email' => '123@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'Kasir',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        

        // Menambahkan data order
        // for ($i = 1; $i <= 10; $i++) {
        //     $id_order = 'ORD' . Carbon::now()->format('YmdHis') . $i;
        //     DB::table('orders')->insert([
        //         'id_order' => $id_order,
        //         'id_user' => '99999999',
        //         'antrian' => $i,
        //         'customer' => 'Customer ' . $i,
        //         'meja' => rand(1, 21),
        //         'tipe_order' => 'Dine In',
        //         'metode_pembayaran' => ['EDC', 'Debit', 'Cash'][array_rand(['EDC', 'Debit', 'Cash'])],
        //         'status' => ['Paid', 'Open Bill', 'Cancelled'][array_rand(['Paid', 'Open Bill', 'Cancelled'])],
        //         'total_harga' => rand(100000, 500000),
        //         'waktu_transaksi' => Carbon::now(),
        //         'updated_on' => Carbon::now(),
        //         'deleted_at' => null,
        //     ]);

        //     // Menambahkan data detail order
        //     for ($j = 1; $j <= 2; $j++) { // Misal setiap order punya 2 detail order
        //         $id_detailorder = 'DORD' . Str::random(10) .  $j;
        //         DB::table('detail_orders')->insert([
        //             'id_detailorder' => $id_detailorder,
        //             'id_order' => $id_order,
        //             'id_menu' => rand(1, 20),
        //             'kuantitas' => rand(1, 5),
        //             'harga_menu' => rand(15000, 100000),
        //             'notes' => 'Notes for menu ' . $i . '-' . $j,
        //             'waktu_transaksi' => Carbon::now(),
        //             'updated_on' => Carbon::now(),
        //             'deleted_at' => null,
        //         ]);

        //         // Menambahkan data detail addon
        //         for ($k = 1; $k <= 2; $k++) { // Misal setiap detail order punya 2 detail addon
        //             $id_detailaddon = 'DADD' . Str::random(3) . $k;
        //             DB::table('detail_addons')->insert([
        //                 'id_detailaddon' => $id_detailaddon,
        //                 'id_addon' => rand(1, 4),
        //                 'id_detailorder' => $id_detailorder,
        //                 'kuantitas' => rand(1, 5),
        //                 'harga' => rand(2000, 7000),
        //                 'waktu_transaksi' => Carbon::now(),
        //                 'updated_on' => Carbon::now(),
        //                 'deleted_at' => null,
        //             ]);
        //         }
        //     }
        // }

        // Menambahkan data untuk relasi kategori dan menu (isi_kategoris)
        for ($i = 1; $i <= 25; $i++) {
            $id_kategori = ($i >= 21 && $i <= 25) ? 4 : rand(1, 3);
            DB::table('isi_kategoris')->insert([
                'id_isi_kategori' => $i,
                'id_kategori' => $id_kategori,
                'id_menu' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
