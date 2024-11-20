<div>
    <h1 class="text-center font-bold text-4xl">Pesanan Manual</h1>
    <div class="border border-black m-5 p-3 grid grid-cols-3 gap-4">
        @foreach ($items as $item)
        <!-- List Menu -->
            <div class="bg-green-300 m-2 p-5" wire:key="menu-{{ $item->id_menu }}">
                <img loading="lazy" src="#" alt="foto di sini"/>
                <p class="font-bold text-2xl">{{ $item->nama_menu }}</p>
                <p>Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>

                <!-- Kuantitas -->
                <div class="flex justify-center">
                    <button class="m-2 text-xl px-5 bg-red-500" wire:click="kurang('{{ $item->id_menu }}')">-</button>
                    <input type="number" class="text-center" min="0" wire:model.debounce.500ms="qty.{{ $item->id_menu }}"/>
                    <button class="m-2 text-xl px-5 bg-green-500" wire:click="tambah('{{ $item->id_menu }}')">+</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border border-black m-5 p-3 flex justify-between">
        <h2 class="text-2xl font-bold">Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h2>
        <!-- Inputan Data Customer -->
        <div class="">
            <div>
                <label>Nama</label>
                <input type="text" class="border border-black" wire:model="customer"/>
            </div>
            <div>
                <label for="Dine In">Dine In</label>
                <input type="radio" id="Dine In" name="tipeOrder" value="Dine In" wire:model="tipeOrder"/>
                <label for="Take Away">Take Away</label>
                <input type="radio" id="Take Away" name="tipeOrder" value="Take Away" wire:model="tipeOrder"/>
            </div>
            <div>
                <label>Table</label>
                <input type="number" class="border border-black" wire:model="meja"
                    @if($tipeOrder === 'Take Away') disabled @endif />
            </div>
        </div>
        <button wire:click="confirmOrder">Confirm</button>
    </div>
    
</div>
{{-- Jadi saya ingin ketika tombol simpan di click, maka data menu-menu yang kuantitasnya bukan 0 akan tersimpan ke dalam table orders.
Dalam table orders, terdapat kolom id_order, id_user, antrian, customer, meja, tipe_order, status, total_harga, waktu_transaksi.
Penjelasan Kolom:
id_order: formatnya adalah ORD + tanggal_transaksi + antrian
id_user: NULL untuk sekarang
antrian: nomor antrian, mulai dari 1, kemudian auto increment, bukan primary key
customer: nama customer, diambil dari inputan nama
meja: jika dine in, maka nomor meja diambil dari inputan meja. Jika take away, maka NULL
tipe_order:
status: karena pesanan baru dibuat, maka otomatis status pasti akan Open Bill
total_harga: diambil total harga dari pesanan
waktu_transaksi: akan dibuat otomatis ketika pesanan di konfirmasi --}}