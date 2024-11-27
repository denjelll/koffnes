<!-- Card Makanan -->
<div id="addonsCard" class="rounded-lg shadow-lg bg-coconut p-4 mt-4" style="margin-right: 20px; margin-left: 20px">
    <!-- Header: Menu Title and Price -->
    <div class="flex items-center mb-4">
        <img src="https://via.placeholder.com/50" alt="Menu Image" class="w-12 h-12 rounded-full">
        <div class="ml-4">
            <h2 class="font-semibold text-lg text-gray-800">Indomie Goreng</h2>
            <p class="text-gray-600">Rp. <span id="basePriceIndomie">11000</span></p>
        </div>
    </div>
    <!-- Addons Section -->
    <div class="mb-4">
        <h3 class="font-semibold text-gray-700">Tambahan</h3>
        <p class="text-sm" style="color:#6a6f4c;">*Pilih sesuai selera</p>
        <div class="space-y-2 mt-2">
            <!-- Option Telor Ceplok -->
            <div class="flex items-center justify-between">
                <p class="text-gray-600">Telor Ceplok</p>
                <div class="flex items-center">
                    <span class="text-gray-500 text-sm mr-2">Rp. 3000</span>
                    <button onclick="decreaseOption('telorCeplok', 3000, 'indomie')" class="w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;">
                        -
                    </button>
                    <span id="telorCeplokCount" class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                        0
                    </span>
                    <button onclick="increaseOption('telorCeplok', 3000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;">
                        +
                    </button>
                </div>
            </div>
            <!-- Option Bakso -->
            <div class="flex items-center justify-between">
                <p class="text-gray-600">Bakso</p>
                <div class="flex items-center">
                    <span class="text-gray-500 text-sm mr-2">Rp. 5000</span>
                    <button onclick="decreaseOption('bakso', 5000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;">
                        -
                    </button>
                    <span id="baksoCount" class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                        0
                    </span>
                    <button onclick="increaseOption('bakso', 5000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;">
                        +
                    </button>
                </div>
            </div>
            <!-- Option Sosis -->
            <div class="flex items-center justify-between">
                <p class="text-gray-600">Sosis</p>
                <div class="flex items-center">
                    <span class="text-gray-500 text-sm mr-2">Rp. 6000</span>
                    <button onclick="decreaseOption('sosis', 6000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;">
                        -
                    </button>
                    <span id="sosisCount" class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                        0
                    </span>
                    <button onclick="increaseOption('sosis', 6000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;">
                        +
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Harga Makanan Satunya -->
    <div class="flex items-center justify-between mt-4">
        <p class="font-semibold text-lg text-gray-800">Total: Rp. <span id="totalPriceIndomie">11000</span></p>
        <div class="flex items-center">
            <button onclick="decreaseQuantity('indomie')" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full mr-2" style="color:white;">
                -
            </button>
            <span id="indomieQuantity" class="mx-4 text-gray-800 font-semibold">1</span>
            <button onclick="increaseQuantity('indomie')" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full ml-2" style="color:white;">
                +
            </button>
        </div>
    </div>
</div>

<!-- Javascript Untuk Card Addons (Masih Sample) -->
<script>
    let indomieQuantity = 1;
let americanoQuantity = 1;
let totalIndomie = 11000; // Base price Indomie
let totalAmericano = 10000; // Base price Americano

let telorCeplokPrice = 3000;
let baksoPrice = 5000;
let sosisPrice = 6000;

// Tambahan harga opsi untuk Indomie
let indomieAddonPrice = 0;

// Update price based on quantity and addon choices
function updatePrice() {
    document.getElementById("totalPriceIndomie").textContent = (totalIndomie * indomieQuantity) + indomieAddonPrice;
    document.getElementById("totalPriceAmericano").textContent = totalAmericano * americanoQuantity;
    document.getElementById("indomieQuantity").textContent = indomieQuantity;
    document.getElementById("americanoQuantity").textContent = americanoQuantity;
}

function increaseQuantity(product) {
    if (product === 'indomie') {
        indomieQuantity++;
    } else if (product === 'americano') {
        americanoQuantity++;
    }
    updatePrice();
}

function decreaseQuantity(product) {
    if (product === 'indomie' && indomieQuantity > 1) {
        indomieQuantity--;
    } else if (product === 'americano' && americanoQuantity > 1) {
        americanoQuantity--;
    }
    updatePrice();
}

function increaseOption(option, price, product) {
    if (product === 'indomie') {
        indomieAddonPrice += price; // Tambahkan harga opsi hanya satu kali
        document.getElementById(option + "Count").textContent = parseInt(document.getElementById(option + "Count").textContent) + 1;
    } else if (product === 'americano') {
        totalAmericano += price;
    }
    updatePrice();
}

function decreaseOption(option, price, product) {
    if (product === 'indomie' && parseInt(document.getElementById(option + "Count").textContent) > 0) {
        indomieAddonPrice -= price; // Kurangi harga opsi hanya satu kali
        document.getElementById(option + "Count").textContent = parseInt(document.getElementById(option + "Count").textContent) - 1;
    } else if (product === 'americano') {
        totalAmericano -= price;
    }
    updatePrice();
}

function openBill() {
    alert("Bill is now open!");
}

</script>











<!-- Card Makanan -->
@foreach ($pesanan as $item)
    <div class="rounded-lg shadow-lg bg-coconut p-4 mt-4" style="margin-right: 20px; margin-left: 20px">
        <!-- Menu Utama -->
        <div class="flex items-center mb-4">
            <img src="{{ $item['gambar'] }}" alt="Foto {{ $item['nama_menu'] }}" class="w-12 h-12 rounded-full">
            <div class="ml-4">
                <h2 class="font-semibold text-lg text-gray-800">{{ $item['nama_menu'] }}</h2>
                <p class="text-gray-600">Rp. <span>{{ number_format($item['harga'], 0, ',', '.') }}</span></p>
            </div>
        </div>

        <!-- Addons -->
        <div class="mb-4">
            @if (isset($addOns[$item['id_menu']]) && $addOns[$item['id_menu']]->isNotEmpty())
                <h3 class="font-semibold text-gray-700">Tambahan</h3>
                <p class="text-sm" style="color:#6a6f4c;">*Pilih sesuai selera</p>
                <div class="space-y-2 mt-2">
                    @foreach ($addOns[$item['id_menu']] as $addon)
                            
                        <div class="flex items-center justify-between">
                            <p class="text-gray-600">{{ $addon->nama_addon }}</p>
                            <div class="flex items-center">
                                <span class="text-gray-500 text-sm mr-2">Rp. {{ number_format($addon->harga, 0, ',', '.') }}</span>
                                <button class="w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;" wire:click="kurangAddOnQty({{ $addon->id_addon }})">
                                -
                                </button>
                                <span class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                                {{ $addOnQty[$addon->id_addon] }}
                                </span>
                                <button class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;" wire:click="tambahAddOnQty({{ $addon->id_addon }})">
                                +
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Total Harga Makanan -->
        <div class="flex items-center justify-between mt-4">
            <p class="font-semibold text-lg text-gray-800">Total: Rp. <span id="totalPriceIndomie">{{ number_format($item['total'], 0, ',', '.') }}</span></p>
            <div class="flex items-center">
                <button class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full mr-2" style="color:white;"  wire:click="kurangQty({{ $item['id_menu'] }})">
                    -
                </button>
                <span class="mx-4 text-gray-800 font-semibold">{{ $item['kuantitas'] }}</span>
                <button class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full ml-2" style="color:white;" wire:click="tambahQty({{ $item['id_menu'] }})">
                    +
                </button>
            </div>
        </div>
    </div>
@endforeach



