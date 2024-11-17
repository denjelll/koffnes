<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koffnes Menu Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url("D:/File UMN/bg kopi.jpg"); /* Replace this with the path to the background image */
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
        }
    </style>
</head>
<body class="font-sans">

    <!-- Navbar -->
    <nav class="bg-[#412f26] text-white px-8 py-4 flex items-center justify-between fixed top-0 left-0 w-full z-50">
        <div class="logo-container">
            <a href="test.html"><img src="koffness2.png" alt="Koffnes Logo" style="width: 150px; height: auto;"></a>
        </div>
        <ul class="flex space-x-8 text-sm">
            <li><a href="#" class="hover:text-gray-300">Menu Management</a></li>
            <li><a href="#" class="hover:text-gray-300">Transaction</a></li>
            <li><a href="#" class="hover:text-gray-300">Event Management</a></li>
            <li><a href="#" class="hover:text-gray-300">Promotion</a></li>
            <li><a href="#" class="hover:text-gray-300">Admin</a></li>
        </ul>
        <button class="bg-white text-[#412f26] px-4 py-2 rounded-md hover:bg-gray-200">Logout</button>
    </nav>
    

    <!-- Main Content -->
    <div class="px-8 py-6 pb-[4rem]">
        <div class="text-2xl font-semibold text-[#412f26] mb-6">Menu Management</div>
        
        <!-- Search and Filter Section -->
        <div class="flex items-center space-x-4 mb-8">
            <button onclick="openModal()" class="bg-[#412f26] text-white px-6 py-2 rounded-lg">Add Menu</button>
            <div class="flex-1 relative">
                <input type="text" placeholder="Search Menu" id="searchInput" oninput="filterMenu()" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#b18968]">
            </div>
            <select id="categoryFilter" onchange="filterMenu()" class="bg-white border border-gray-300 text-[#412f26] rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[#b18968]">
                <option value="All">All Categories</option>
                <option value="Food">Food</option>
                <option value="Drink">Drink</option>
                <option value="Snack">Snack</option>
            </select>
        </div>

        <!-- Divider Line -->
        <hr class="border-t border-[#b18968] mb-8">

<!-- Food Section -->
<section class="my-6">
    <h2 class="text-2xl font-bold text-[#412f26] mb-4">Food</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        <!-- Food Menu Item Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Nasi Lemak</h3>
                <p class="text-[#b18968] text-center">Rp. 15.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Nasi Lemak</h3>
                <p class="text-[#b18968] text-center">Rp. 15.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Nasi Lemak</h3>
                <p class="text-[#b18968] text-center">Rp. 15.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Nasi Lemak</h3>
                <p class="text-[#b18968] text-center">Rp. 15.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Nasi Lemak</h3>
                <p class="text-[#b18968] text-center">Rp. 15.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Nasi Lemak</h3>
                <p class="text-[#b18968] text-center">Rp. 15.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Nasi Lemak</h3>
                <p class="text-[#b18968] text-center">Rp. 15.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <!-- Add more food items here -->
    </div>
</section>

<!-- Drinks Section -->
<section class="my-6">
    <h2 class="text-2xl font-bold text-[#412f26] mb-4">Drinks</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        <!-- Drinks Menu Item Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Iced Tea" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Iced Tea</h3>
                <p class="text-[#b18968] text-center">Rp. 10.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Iced Tea" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Iced Tea</h3>
                <p class="text-[#b18968] text-center">Rp. 10.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Iced Tea" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Iced Tea</h3>
                <p class="text-[#b18968] text-center">Rp. 10.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Iced Tea" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Iced Tea</h3>
                <p class="text-[#b18968] text-center">Rp. 10.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <!-- Add more drink items here -->
    </div>
</section>

<!-- Snack Section -->
<section class="my-6">
    <h2 class="text-2xl font-bold text-[#412f26] mb-4">Snacks</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        <!-- Snack Menu Item Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Iced Tea" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Chiki</h3>
                <p class="text-[#b18968] text-center">Rp.  5.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Iced Tea" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Chiki</h3>
                <p class="text-[#b18968] text-center">Rp.  5.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Iced Tea" class="w-full h-32 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#412f26] text-center">Chiki</h3>
                <p class="text-[#b18968] text-center">Rp.  5.000</p>
                <button onclick="openModal()" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
            </div>
        </div>

        <!-- Add more snack items here -->
    </div>
</section>


    <!-- Modal for Add/Edit Menu -->
    <div id="menuModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-[#f1e8d4] w-96 p-8 rounded-lg shadow-lg relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-[#412f26] font-bold text-lg">&times;</button>
            <h2 class="text-2xl font-semibold text-[#412f26] mb-4 text-center">Add/Edit Menu</h2>
            <div class="mb-4">
                <input type="hidden" id="menuIndex">
                <label class="block text-[#412f26] font-bold">Nama Menu:</label>
                <input type="text" id="menuName" class="w-full p-2 border rounded-lg mb-2">
                <label class="block text-[#412f26] font-bold">Harga:</label>
                <input type="number" id="menuPrice" class="w-full p-2 border rounded-lg mb-2">
                <label class="block text-[#412f26] font-bold">Kategori:</label>
                <select id="menuCategory" class="w-full p-2 border rounded-lg mb-2">
                    <option value="Food">Food</option>
                    <option value="Drink">Drink</option>
                    <option value="Snack">Snack</option>
                </select>
                <label class="block text-[#412f26] font-bold">Deskripsi:</label>
                <textarea id="menuDescription" class="w-full p-2 border rounded-lg mb-2"></textarea>
                <label class="block text-[#412f26] font-bold">Stok:</label>
                <input type="number" id="menuStock" class="w-full p-2 border rounded-lg mb-4">
                <button onclick="addOrUpdateMenu()" class="bg-[#412f26] text-white w-full py-2 rounded-lg">Add/Update</button>
            </div>
        </div>
    </div>

    <footer
    class="w-full p-4 fixed bottom-0 left-0 z-30 flex flex-col items-center text-white"
    style="background-color: #412f26; height: 64px;">
    <img
        src="../img/8.png"
        alt="Footer Logo"
        class="h-7 md:h-7 mb-2"
        style="max-width: 180px;">
    <p class="text-sm">&copy; 2024 Koffnes. All rights reserved.</p>
</footer>
    <!-- JavaScript -->
    <script>
        let menuData = [
            { name: 'Nasi Lemak', price: 15000, category: 'Food', description: 'Delicious rice dish', stock: 20 },
            { name: 'Iced Coffee', price: 10000, category: 'Drink', description: 'Refreshing iced coffee', stock: 30 },
            { name: 'Potato Chips', price: 5000, category: 'Snack', description: 'Crispy and salty', stock: 50 },
        ];

        function openModal(index = null) {
            document.getElementById('menuModal').classList.remove('hidden');
            if (index !== null) {
                document.getElementById('menuIndex').value = index;
                const menu = menuData[index];
                document.getElementById('menuName').value = menu.name;
                document.getElementById('menuPrice').value = menu.price;
                document.getElementById('menuCategory').value = menu.category;
                document.getElementById('menuDescription').value = menu.description;
                document.getElementById('menuStock').value = menu.stock;
            } else {
                document.getElementById('menuIndex').value = '';
                document.getElementById('menuName').value = '';
                document.getElementById('menuPrice').value = '';
                document.getElementById('menuCategory').value = 'Food';
                document.getElementById('menuDescription').value = '';
                document.getElementById('menuStock').value = '';
            }
        }

        function closeModal() {
            document.getElementById('menuModal').classList.add('hidden');
        }

        function addOrUpdateMenu() {
            const index = document.getElementById('menuIndex').value;
            const menu = {
                name: document.getElementById('menuName').value,
                price: document.getElementById('menuPrice').value,
                category: document.getElementById('menuCategory').value,
                description: document.getElementById('menuDescription').value,
                stock: document.getElementById('menuStock').value
            };

            if (index) {
                menuData[index] = menu;
            } else {
                menuData.push(menu);
            }
            closeModal();
            filterMenu();
        }

        function renderMenuItems(filteredData = menuData) {
            const menuGrid = document.getElementById('menuGrid');
            menuGrid.innerHTML = '';
            filteredData.forEach((menu, index) => {
                const card = document.createElement('div');
                card.className = 'bg-white shadow-lg rounded-lg overflow-hidden';
                card.innerHTML = `
                    <img src="https://via.placeholder.com/150" alt="${menu.name}" class="w-full h-32 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-[#412f26] text-center">${menu.name}</h3>
                        <p class="text-[#b18968] text-center">Rp. ${menu.price}</p>
                        <button onclick="openModal(${index})" class="mt-3 w-full bg-[#412f26] text-white py-2 rounded-lg">EDIT</button>
                    </div>
                `;
                menuGrid.appendChild(card);
            });
        }

        function filterMenu() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const filteredData = menuData.filter(menu => 
                (menu.name.toLowerCase().includes(searchValue) || menu.description.toLowerCase().includes(searchValue)) &&
                (categoryFilter === 'All' || menu.category === categoryFilter)
            );
            renderMenuItems(filteredData);
        }

        // Initial render
        renderMenuItems();
    </script>

</body>
</html>
