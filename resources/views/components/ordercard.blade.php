<div>
    <div
        class="flex items-center justify-between w-full px-4 py-3 bg-[#f5e7d9] rounded-full shadow-md mt-6">
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-[#412f26]">1#</span>
            <span class="font-semibold text-[#412f26]">Pak Tatang</span>
        </div>

        <!-- Right-aligned Buttons -->
        <div class="flex items-center ml-auto space-x-3">
            <!-- Checklist Button -->
            <button
                id="checklist-btn"
                class="flex items-center justify-center bg-[#412f26] text-white rounded-full w-8 h-8"
                onclick="openModal()">
                <h2 class="text-sm">✓</h2>
            </button>

            <!-- Plus Button (Opens Edit Order Popup) -->
            <button
                id="plus-btn"
                class="flex items-center justify-center bg-[#412f26] text-white rounded-full w-8 h-8"
                onclick="openEditOrderModal()">
                <h3 class="text-xl">+</h3>
            </button>

            <!-- Close Button (X) -->
            <button
                id="close-btn"
                class="flex items-center justify-center bg-[#412f26] text-white rounded-full w-8 h-8"
                onclick="closeModal()">
                <h2 class="text-md">x</h2>
            </button>
        </div>
    </div>
</div>

<!-- Popup Modal (Konfirmasi Pembayaran) -->
<div
    id="payment-modal"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50">
    <div class="bg-[#e8d2b7] p-12 rounded-lg w-1/2 shadow-lg">
        <h3 class="text-2xl font-bold text-[#412f26] mb-6">Konfirmasi Pembayaran</h3>
        <div class="mb-6">
            <p class="text-[#412f26]"><strong>Detail Pesanan:</strong></p>
            <ul id="order-list" class="text-[#412f26] mb-4">
                <!-- Daftar menu akan dimasukkan secara dinamis di sini -->
            </ul>
            <p class="text-[#412f26]"><strong>Total Harga:</strong> Rp <span id="total-price">0</span></p>
        </div>
        <div class="mb-6">
            <label for="payment-method" class="block mb-2 text-[#412f26]">Metode Pembayaran</label>
            <select
                id="payment-method"
                class="w-full p-3 border border-gray-300 rounded-md bg-[#f5e7d9]"
                onchange="toggleCashSection()">
                <option value="edc">EDC</option>
                <option value="cash">Cash</option>
                <option value="debit">Debit</option>
            </select>
        </div>
        <div id="cash-section" class="hidden mb-6">
            <label for="payment-amount" class="block mb-2 text-[#412f26]">Jumlah Uang yang Dibayar</label>
            <input
                type="number"
                id="payment-amount"
                class="w-full p-3 border border-gray-300 rounded-md bg-[#f5e7d9]"
                placeholder="Masukkan jumlah uang" oninput="calculateChange()"/>
            <p id="change" class="mt-2 text-[#412f26]">Kembalian: Rp 0</p>
        </div>
        <div class="flex justify-end mt-6 space-x-4">
            <button id="cancel-btn" class="bg-[#412f26] text-white p-4 rounded-md hover:bg-[#e8d2b7]" onclick="closeModal()">Batal</button>
            <button id="confirm-btn" class="bg-[#412f26] text-white p-4 rounded-md hover:bg-[#e8d2b7]" onclick="confirmPayment()">Konfirmasi</button>
        </div>
    </div>
</div>


<!-- Edit Order Modal -->
<div
    id="edit-order-modal"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50">
    <div class="bg-[#e8d2b7] p-12 rounded-lg w-1/2 shadow-lg">
        <h3 class="text-2xl font-bold text-[#412f26] mb-6">Edit Pesanan</h3>

        <!-- Menu Utama -->
        <div class="mb-6">
            <p class="text-[#412f26]"><strong>Menu Utama:</strong></p>
            <div id="main-menu" class="space-y-6">
                <!-- Dynamic Menu Items -->
            </div>
        </div>

        <!-- Addons -->
        <div class="mb-6">
            <p class="text-[#412f26]"><strong>Addons:</strong></p>
            <div id="addons-menu" class="space-y-6">
                <!-- Dynamic Addons -->
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end mt-6 space-x-4">
            <button id="save-btn" class="bg-[#412f26] text-white p-4 rounded-md hover:bg-[#e8d2b7]" onclick="saveOrder()">Simpan</button>
            <button id="close-edit-btn" class="bg-[#412f26] text-white p-4 rounded-md hover:bg-[#e8d2b7]" onclick="closeEditOrderModal()">Batal</button>
        </div>
    </div>
</div>


<script>
    // Data menu yang dipesan
    const orderItems = [
        { name: "Katsu", quantity: 1, price: 28000 },
        { name: "Indomie", quantity: 1, price: 18000 }
    ];

    // Fungsi untuk menampilkan modal konfirmasi pembayaran
    function openModal() {
        displayOrder();
        document.getElementById('payment-modal').style.display = 'flex';
    }

    // Fungsi untuk menutup modal konfirmasi pembayaran
    function closeModal() {
        document.getElementById('payment-modal').style.display = 'none';
    }

    // Fungsi untuk membuka modal edit pesanan
    function openEditOrderModal() {
        const mainMenu = document.getElementById('main-menu');
        const addonsMenu = document.getElementById('addons-menu');
        
        mainMenu.innerHTML = ''; // Clear previous items
        addonsMenu.innerHTML = ''; // Clear previous addons

        // Menampilkan menu utama
        orderItems.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.classList.add('flex', 'items-center', 'justify-between');
            itemDiv.innerHTML = `
                <span>${item.name}</span>
                <div class="flex items-center space-x-2">
                    <button onclick="updateQuantity('${item.name}', -1)" class="bg-[#412f26] text-white p-2 rounded-md">-</button>
                    <span>${item.quantity}</span>
                    <button onclick="updateQuantity('${item.name}', 1)" class="bg-[#412f26] text-white p-2 rounded-md">+</button>
                    <span>Rp ${item.price.toLocaleString()}</span>
                </div>
            `;
            mainMenu.appendChild(itemDiv);
        });

        // Menampilkan modal edit pesanan
        document.getElementById('edit-order-modal').style.display = 'flex';
    }

    // Fungsi untuk menutup modal edit pesanan
    function closeEditOrderModal() {
        document.getElementById('edit-order-modal').style.display = 'none';
    }

    // Fungsi untuk mengupdate jumlah item
    function updateQuantity(name, delta) {
        const item = orderItems.find(item => item.name === name);
        if (item) {
            item.quantity = Math.max(1, item.quantity + delta);
            openEditOrderModal(); // Refresh the modal
        }
    }

    // Fungsi untuk menyimpan perubahan pesanan
    function saveOrder() {
        alert('Pesanan telah disimpan!');
        closeEditOrderModal();
    }

    // Fungsi untuk menampilkan daftar pesanan
    function displayOrder() {
        const orderList = document.getElementById('order-list');
        const totalPriceElement = document.getElementById('total-price');
        let totalPrice = 0;

        orderList.innerHTML = ""; // Clear previous order list

        // Loop untuk menambahkan item ke daftar pesanan
        orderItems.forEach(item => {
            const itemTotal = item.quantity * item.price;
            totalPrice += itemTotal;

            const listItem = document.createElement('li');
            listItem.textContent = `${item.name} x ${item.quantity} - Rp ${itemTotal.toLocaleString()}`;
            orderList.appendChild(listItem);
        });

        // Menampilkan total harga
        totalPriceElement.textContent = totalPrice.toLocaleString();
    }

    // Fungsi untuk mengonfirmasi pembayaran
    function confirmPayment() {
        alert("Pembayaran telah dikonfirmasi!");
        closeModal();
    }

    // Fungsi untuk menampilkan atau menyembunyikan input jumlah uang yang dibayar
    function toggleCashSection() {
        const paymentMethod = document.getElementById('payment-method').value;
        const cashSection = document.getElementById('cash-section');

        if (paymentMethod === 'cash') {
            cashSection.classList.remove('hidden');
        } else {
            cashSection.classList.add('hidden');
        }
    }

    // Fungsi untuk menghitung kembalian
    function calculateChange() {
        const totalPrice = parseInt(document.getElementById('total-price').textContent.replace(/,/g, ''));
        const paymentAmount = parseInt(document.getElementById('payment-amount').value) || 0;
        const change = paymentAmount - totalPrice;

        document.getElementById('change').textContent = `Kembalian: Rp ${change >= 0 ? change.toLocaleString() : '0'}`;
    }
</script>
