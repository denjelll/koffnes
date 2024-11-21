<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Koffnes Admin Management</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body {
        background-image: url("D:/File UMN/bg kopi.jpg");
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
<div class="px-8 py-6 mt-20">
    <div class="text-2xl font-semibold text-[#412f26] mb-6">Admin Management</div>

    <!-- Add New Admin Button -->
    <div class="flex justify-end mb-6">
        <button onclick="openAdminModal()" class="bg-[#412f26] text-white px-6 py-2 rounded-lg">Add New Admin</button>
    </div>

    <!-- Admin List Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-[#412f26] text-white">
                <tr>
                    <th class="w-1/2 py-2">List of Admin</th>
                    <th class="w-1/4 py-2">Action</th>
                </tr>
            </thead>
            <tbody id="adminTable" class="text-center">
                <!-- Admin List Rows -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Add/Edit Admin -->
<div id="adminModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-[#f1e8d4] w-[400px] p-8 rounded-lg shadow-lg relative">
        <button onclick="closeAdminModal()" class="absolute top-2 right-2 text-[#412f26] font-bold text-lg">&times;</button>
        <h2 class="text-2xl font-semibold text-[#412f26] mb-4 text-center">Add New Admin</h2>
        
        <input type="hidden" id="adminIndex">

        <!-- Nama Field -->
        <label class="block text-[#412f26] font-bold mb-2">Nama:</label>
        <input type="text" id="adminName" class="w-full p-2 border rounded-lg mb-4" placeholder="Nama Admin">

        <!-- Email Field -->
        <label class="block text-[#412f26] font-bold mb-2">Email:</label>
        <input type="email" id="adminEmail" class="w-full p-2 border rounded-lg mb-4" placeholder="Email Admin">

        <!-- Password Field -->
        <label class="block text-[#412f26] font-bold mb-2">Password:</label>
        <input type="password" id="adminPassword" class="w-full p-2 border rounded-lg mb-4" placeholder="Password">

        <!-- Confirmation Password Field -->
        <label class="block text-[#412f26] font-bold mb-2">Confirmation Password:</label>
        <input type="password" id="adminConfirmPassword" class="w-full p-2 border rounded-lg mb-4" placeholder="Konfirmasi Password">

        <!-- Current Admin Password Field -->
        <label class="block text-[#412f26] font-bold mb-2">Current Admin Password:</label>
        <input type="password" id="currentAdminPassword" class="w-full p-2 border rounded-lg mb-4" placeholder="Password Admin Saat Ini">

        <button onclick="addOrUpdateAdmin()" class="bg-[#412f26] text-white w-full py-2 rounded-lg">Add Admin</button>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div id="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-[#f1e8d4] w-[300px] p-6 rounded-lg shadow-lg text-center">
        <h3 class="text-xl font-bold text-[#412f26] mb-4">Are you sure?</h3>
        <p class="text-[#412f26] mb-6">Do you really want to delete this admin? This process cannot be undone.</p>
        <div class="flex justify-center gap-4">
            <button onclick="confirmDelete()" class="bg-red-600 text-white px-4 py-2 rounded-lg">Yes</button>
            <button onclick="closeDeleteModal()" class="bg-gray-200 text-[#412f26] px-4 py-2 rounded-lg">No</button>
        </div>
    </div>
</div>

<footer class="w-full p-4 fixed bottom-0 left-0 z-30 flex flex-col items-center text-white" style="background-color: #412f26; height: 64px;">
    <img src="../img/8.png" alt="Footer Logo" class="h-7 md:h-7 mb-2" style="max-width: 180px;">
    <p class="text-sm">&copy; 2024 Koffnes. All rights reserved.</p>
</footer>

<!-- JavaScript -->
<script>
    let adminData = [
        { name: 'John Doe', email: 'johndoe@gmail.com' },
        { name: 'Budi Santoso', email: 'budisantoso23@gmail.com' },
        { name: 'Dhean', email: 'dhean@gmail.com' }
    ];

    let deleteIndex = null;

    function openAdminModal(index = null) {
        document.getElementById('adminModal').classList.remove('hidden');
        if (index !== null) {
            const admin = adminData[index];
            document.getElementById('adminIndex').value = index;
            document.getElementById('adminName').value = admin.name;
            document.getElementById('adminEmail').value = admin.email;
        } else {
            document.getElementById('adminIndex').value = '';
        }
    }

    function closeAdminModal() {
        document.getElementById('adminModal').classList.add('hidden');
    }

    function addOrUpdateAdmin() {
        const index = document.getElementById('adminIndex').value;
        const admin = {
            name: document.getElementById('adminName').value,
            email: document.getElementById('adminEmail').value,
        };

        if (!admin.name || !admin.email) {
            alert('Semua field harus diisi!');
            return;
        }

        if (index) {
            adminData[index] = admin;
        } else {
            adminData.push(admin);
        }
        closeAdminModal();
        renderAdminTable();
    }

    function deleteAdmin(index) {
        deleteIndex = index;
        document.getElementById('confirmDeleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('confirmDeleteModal').classList.add('hidden');
        deleteIndex = null;
    }

    function confirmDelete() {
        if (deleteIndex !== null) {
            adminData.splice(deleteIndex, 1);
            renderAdminTable();
        }
        closeDeleteModal();
    }

    function renderAdminTable() {
        const adminTable = document.getElementById('adminTable');
        adminTable.innerHTML = '';
        adminData.forEach((admin, index) => {
            const adminRow = `
                <tr>
                    <td class="py-2">${admin.name} (${admin.email})</td>
                    <td class="py-2">
                        <button onclick="openAdminModal(${index})" class="bg-[#b18968] text-white px-4 py-1 rounded-md">Edit</button>
                        <button onclick="deleteAdmin(${index})" class="bg-red-600 text-white px-4 py-1 rounded-md ml-2">Delete</button>
                    </td>
                </tr>
            `;
            adminTable.innerHTML += adminRow;
        });
    }

    document.addEventListener('DOMContentLoaded', renderAdminTable);
</script>

</body>

</html>
