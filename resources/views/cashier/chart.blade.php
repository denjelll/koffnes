<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cashnes</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <!-- Navbar -->
        <nav
            class="bg-[#412f26] p-4 fixed top-0 w-full z-10 flex items-center justify-between text-white">
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
                    <a href="{{ url('/cashier/home') }}">Keranjang</a>
                </spa>
            </button>
        </nav>

        <!-- Main Content (for spacing) -->
        <div class="pt-[5rem] p-4 pb-[20rem] md:pb-[16rem] lg:pb-[13rem]">
            <!-- Your main content goes here -->
            <!-- Card -->
            <x-chart/>
            <x-chart/>
            <x-chart/>
            <x-chart/>
            <x-chart/>
            <x-chart/>
            <x-chart/>
        </div>

        <!-- Footer -->
        <footer class="fixed bottom-0 w-full bg-[#f3e6dd] p-4 rounded-t-lg shadow-md">
            <div
                class="flex flex-col md:flex-row md:justify-between items-start space-y-4 md:space-y-0">
                <!-- Total Price -->
                <div class="text-lg font-bold text-[#412f26] md:mr-4">
                    <span class="text-2xl">Total :</span>
                    <div class="text-2xl">Rp. 45.000,00-</div>
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

            <div class="mt-4 flex flex-wrap justify-center gap-4">
                <a href="{{ url('/cashier/order') }}">
                    <button
                        class="p-3 bg-[#412f26] text-white rounded-full font-semibold text-center hover:bg-[#5f3c21] w-40 sm:w-60 md:w-72 lg:w-80">
                        Open Bill
                    </button>
                </a>
                <a href="{{ url('/cashier/checkout') }}">
                    <button
                        class="p-3 bg-[#412f26] text-white rounded-full font-semibold text-center hover:bg-[#5f3c21] w-40 sm:w-60 md:w-72 lg:w-80">
                        Check Out
                    </button>
                </a>
            </div>

        </footer>
    </body>
</html>








