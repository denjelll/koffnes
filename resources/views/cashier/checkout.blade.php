<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cashnes</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            // Function to toggle the modal visibility
            function toggleModal() {
                const modal = document.getElementById('paymentModal');
                modal
                    .classList
                    .toggle('hidden');
            }
        </script>
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
                    <a href="{{ url('/cashier/chart') }}">Checkout</a>
                </span>
            </button>
        </nav>

        <div
            class="pt-[5rem] min-h-screen flex items-center justify-center p-4 pb-[17rem]">
            <!-- Card Content with floating effect -->
            <div
                class="bg-[#e8d2b7] rounded-lg shadow-lg transform transition-all duration-300 hover:scale-105 p-8 w-full max-w-xl">
                <div class="mb-6 border-b border-black">
                    <div
                        class="py-3 grid grid-cols-3 gap-4 text-base font-semibold border-b border-black">
                        <span>Nama Produk</span>
                        <span>Jumlah Produk</span>
                        <span>Total Harga per Produk</span>
                    </div>
                    <x-checkout/>
                    <x-checkout/>
                    <x-checkout/>
                    <x-checkout/>
                    <x-checkout/>
                    <x-checkout/>
                    <x-checkout/>
                </div>

                <!-- Total Price section -->
                <div class="py-3 grid grid-cols-3 gap-4 text-base">
                    <p class="text-xl font-bold mb-6 col-span-2">Total</p>
                    <span class="text-right font-bold text-end">Rp. 81.000,00</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="fixed bottom-0 w-full bg-[#f3e6dd] p-4 rounded-t-lg shadow-md">
            <div
                class="flex flex-col md:flex-row md:justify-between items-start space-y-4 md:space-y-0">
                <!-- Total Price -->
                <div class="text-lg font-bold text-[#412f26] md:mr-4">
                    <span class="text-2xl">Total price:</span>
                    <div class="text-2xl">Rp. 81.000,00-</div>
                </div>

                <!-- Input Fields and Options -->
                <div class="space-y-2 w-full md:w-auto">
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-semibold text-[#412f26]">Name:</label>
                        <p class="text-sm font-semibold text-[#412f26]">Pak Tatang</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-semibold text-[#412f26]">Table:</label>
                        <p class="text-sm font-semibold text-[#412f26]">1</p>
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

            <!-- Checkout Button (Triggers Modal) -->
            <div class="mt-4 flex flex-wrap justify-center gap-4">
                <button
                    onclick="toggleModal()"
                    class="p-3 bg-[#412f26] text-white rounded-full font-semibold text-center hover:bg-[#5f3c21] w-40 sm:w-60 md:w-72 lg:w-80">
                    Checkout
                </button>
                <a href="{{ url('/cashier/home') }}">
                    <button
                        class="p-3 bg-[#412f26] text-white rounded-full font-semibold text-center hover:bg-[#5f3c21] w-40 sm:w-60 md:w-72 lg:w-80">
                        Add more
                    </button>
                </a>
            </div>
        </footer>
        <!-- Modal for Payment Confirmation -->
        <div
            id="paymentModal"
            class="hidden fixed inset-0 bg-gray-700 bg-opacity-50 flex justify-center items-center z-50">
            <div
                class="p-6 w-96 rounded-lg shadow-md bg-gradient-to-br from-[#f0e6d6] to-[#d9cab3] flex flex-col relative">
                <!-- Tombol Tutup -->
                <button
                    onclick="toggleModal()"
                    class="absolute top-3 right-3 w-8 h-8 rounded-full bg-[#412f26] hover:scale-110 transition-transform flex items-center justify-center shadow-md">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewbox="0 0 24 24"
                        stroke="currentColor"
                        class="w-5 h-5 text-[#e8d2b7]">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Judul Modal -->
                <h2 class="text-2xl font-bold mb-4 text-[#412f26] text-center drop-shadow-lg">
                    Payment Method
                </h2>
                <p class="text-sm text-[#7d6c5b] mb-6 text-center">
                    Please select your preferred method of payment:
                </p>

                <!-- Pilihan Metode Pembayaran -->
                <div class="space-y-4">
                    <label
                        class="group flex items-center gap-3 py-3 px-4 rounded-md shadow-sm cursor-pointer bg-[#f7ead6] hover:scale-105 transition-transform">
                        <div
                            class="p-2 bg-white rounded-md shadow-md group-hover:bg-[#ffba66] transition-all"></div>
                        <span class="text-[#412f26] text-sm font-medium">EDC</span>
                        <input
                            type="radio"
                            name="payment"
                            value="EDC"
                            class="hidden"
                            onchange="handlePayment('EDC')"/>
                    </label>

                    <label
                        class="group flex items-center gap-3 py-3 px-4 rounded-md shadow-sm cursor-pointer bg-[#f7ead6] hover:scale-105 transition-transform">
                        <div
                            class="p-2 bg-white rounded-md shadow-md group-hover:bg-[#ffba66] transition-all"></div>
                        <span class="text-[#412f26] text-sm font-medium">Debit</span>
                        <input
                            type="radio"
                            name="payment"
                            value="Debit"
                            class="hidden"
                            onchange="handlePayment('Debit')"/>
                    </label>

                    <label
                        class="group flex items-center gap-3 py-3 px-4 rounded-md shadow-sm cursor-pointer bg-[#f7ead6] hover:scale-105 transition-transform">
                        <div
                            class="p-2 bg-white rounded-md shadow-md group-hover:bg-[#ffba66] transition-all"></div>
                        <span class="text-[#412f26] text-sm font-medium">Cash</span>
                        <input
                            type="radio"
                            name="payment"
                            value="Cash"
                            class="hidden"
                            onchange="handlePayment('Cash')"/>
                    </label>
                </div>
            </div>
        </div>

        <!-- Modal "Terima Kasih Telah Berkunjung" -->
        <div
            id="thankYouModal"
            class="hidden fixed inset-0 bg-gray-700 bg-opacity-50 flex justify-center items-center z-50">
            <div
                class="p-6 w-96 rounded-lg shadow-md bg-gradient-to-br from-[#f7ead6] to-[#d9cab3] flex flex-col items-center">
                <h2 class="text-2xl font-bold text-[#412f26] mb-4 text-center">
                    Terima Kasih Telah Berkunjung!
                </h2>
                <p class="text-sm text-[#7d6c5b] text-center">
                    Kami senang melayani Anda. Sampai jumpa lagi!
                </p>
            </div>
        </div>

        <script>
            function handlePayment(paymentMethod) {
                // Tampilkan modal "Terima Kasih"
                const thankYouModal = document.getElementById('thankYouModal');
                thankYouModal
                    .classList
                    .remove('hidden');

                // Sembunyikan modal setelah 2 detik dan arahkan ke menu.php
                setTimeout(() => {
                    thankYouModal
                        .classList
                        .add('hidden');
                    window.location.href = "{{ url('/cashier/home') }}";
                }, 1000);
            }
        </script>

    </body>
</html>