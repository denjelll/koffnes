<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cashnes</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">

        <!-- Navbar -->
        <nav
            class="bg-[#412f26] p-4 fixed top-0 w-full z-10 flex items-center justify-between text-white shadow-md">
            <!-- Kembali Button -->
            <button class="flex items-center space-x-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewbox="0 0 24 24"
                    stroke="currentColor"
                    class="w-6 h-6">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>
                    <a href="chart.php" class="text-sm font-semibold hover:underline">Edit Order</a>
                </span>
            </button>
        </nav>

        <!-- Main Content -->
        <div class="pt-[5rem] p-4 pb-[17rem]">
            <div
                class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8 md:max-w-xl lg:max-w-2xl">
                <!-- Card Header -->
                <div class="flex items-center mb-4 border-b pb-3">
                    <img
                        src="your-image-url.jpg"
                        alt="Kopi Croissant"
                        class="w-12 h-12 rounded-full object-cover">
                    <div class="ml-3">
                        <h2 class="text-lg font-bold text-gray-800">Kopi Croissant</h2>
                        <p class="text-sm text-gray-500">Rp. 15.000</p>
                    </div>
                </div>
                <!-- Addons -->
                <div class="mb-4">
                    <h3 class="text-md font-semibold mb-2">Takaran Gula</h3>
                    <p class="text-sm text-gray-500 mb-2">Harus Pilih - Pilih 1</p>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="takaran_gula"
                                value="normal"
                                class="w-4 h-4 text-green-500 focus:ring-green-500">
                            <span class="ml-2">Normal</span>
                            <span class="ml-auto text-sm text-gray-500">Free</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="takaran_gula"
                                value="less_sugar"
                                class="w-4 h-4 text-green-500 focus:ring-green-500">
                            <span class="ml-2">Less Sugar</span>
                            <span class="ml-auto text-sm text-gray-500">Free</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="takaran_gula"
                                value="no_sugar"
                                class="w-4 h-4 text-green-500 focus:ring-green-500">
                            <span class="ml-2">No Sugar</span>
                            <span class="ml-auto text-sm text-gray-500">Free</span>
                        </label>
                    </div>
                </div>
                <div>
                    <h3 class="text-md font-semibold mb-2">Jenis Croissant</h3>
                    <p class="text-sm text-gray-500 mb-2">Harus Pilih - Pilih 1</p>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="jenis_croissant"
                                value="polos"
                                class="w-4 h-4 text-green-500 focus:ring-green-500">
                            <span class="ml-2">Polos</span>
                            <span class="ml-auto text-sm text-gray-500">Free</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="jenis_croissant"
                                value="cokelat"
                                class="w-4 h-4 text-green-500 focus:ring-green-500">
                            <span class="ml-2">Cokelat</span>
                            <span class="ml-auto text-sm text-gray-500">Free</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="jenis_croissant"
                                value="blueberry"
                                class="w-4 h-4 text-green-500 focus:ring-green-500">
                            <span class="ml-2">Blueberry</span>
                            <span class="ml-auto text-sm text-gray-500">Free</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="fixed bottom-0 w-full bg-[#f3e6dd] p-4 rounded-t-lg shadow-md">
            <div
                class="flex flex-col md:flex-row md:justify-between items-start space-y-4 md:space-y-0">
                <!-- Total Price -->
                <div class="text-lg font-bold text-[#412f26] md:mr-4">
                    <span class="text-2xl">Total :</span>
                    <div class="text-2xl">Rp. 45.000,00</div>
                </div>

                <!-- Input Fields and Options -->
                <div class="space-y-2 w-full md:w-auto">
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-semibold text-[#412f26]">Name:</label>
                        <input
                            type="text"
                            placeholder="Siapa nichh.."
                            class="p-1 text-sm border rounded border-[#412f26] focus:outline-none focus:border-[#412f26] w-1/2 md:w-auto">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-semibold text-[#412f26]">Table:</label>
                        <input
                            type="number"
                            placeholder="..."
                            class="w-12 p-1 text-sm border rounded border-[#412f26] focus:outline-none focus:border-[#412f26]">
                    </div>
                    <div class="flex items-center space-x-4">
                        <label class="text-sm font-semibold text-[#412f26]">Dine In</label>
                        <input
                            type="radio"
                            name="dining_option"
                            value="dine_in"
                            checked="checked"
                            class="form-radio text-[#412f26]">
                        <label class="text-sm font-semibold text-[#412f26]">Take Away</label>
                        <input
                            type="radio"
                            name="dining_option"
                            value="take_away"
                            class="form-radio text-[#412f26]">
                    </div>
                </div>
            </div>

            <!-- Open Bill Button -->
            <a href="chart.php">
                <div class="mt-4 flex justify-center">
                    <button
                        class="w-full md:w-[300px] p-3 bg-[#412f26] text-white rounded-full font-semibold text-center hover:bg-[#5f3c21]">Update Bill</button>
                </div>
            </a>
        </footer>

    </body>
</html>