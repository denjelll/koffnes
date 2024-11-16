<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Checkout</h1>

    @if (empty($cartItems))
        <p class="text-gray-500">Cart is empty.</p>
    @else
        <table class="table-auto w-full mb-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">Menu</th>
                    <th class="border border-gray-300 p-2">Quantity</th>
                    <th class="border border-gray-300 p-2">Add-Ons</th>
                    <th class="border border-gray-300 p-2">Notes</th>
                    <th class="border border-gray-300 p-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td class="border border-gray-300 p-2">
                            <img src="{{ $item['menu']->gambar }}" alt="{{ $item['menu']->nama_menu }}" class="w-12 h-12 object-cover">
                            <div>{{ $item['menu']->nama_menu }}</div>
                            <div class="text-sm text-gray-500">{{ $item['menu']->deskripsi_menu }}</div>
                        </td>
                        <td class="border border-gray-300 p-2">
                            <button wire:click="updateCartItem('{{ $item['menu']->id_menu }}', {{ max($item['quantity'] - 1, 0) }})" 
                                class="px-2 py-1 bg-red-500 text-white rounded">-</button>
                            {{ $item['quantity'] }}
                            <button wire:click="updateCartItem('{{ $item['menu']->id_menu }}', {{ $item['quantity'] + 1 }})" 
                                class="px-2 py-1 bg-green-500 text-white rounded">+</button>
                        </td>
                        <td class="border border-gray-300 p-2">
                            @if (count($item['addOns']) > 0)
                                <select wire:change="updateCartItem('{{ $item['menu']->id_menu }}', {{ $item['quantity'] }}, $event.target.value)"
                                        class="border border-gray-300 rounded w-full">
                                    <option value="" {{ !$item['selectedAddOn'] ? 'selected' : '' }}>None</option>
                                    @foreach ($item['addOns'] as $addOn)
                                        <option value="{{ $addOn->id_addon }}" {{ $item['selectedAddOn'] == $addOn->id_addon ? 'selected' : '' }}>
                                            {{ $addOn->nama_addon }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <span>No add-ons available</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-2">
                            <input type="text" wire:input="updateCartItem('{{ $item['menu']->id_menu }}', {{ $item['quantity'] }}, $event.target.value, '{{ $item['selectedAddOn'] }}')"
                                   class="border border-gray-300 rounded w-full" placeholder="Notes" value="{{ $item['notes'] }}">
                        </td>
                        <td class="border border-gray-300 p-2">Rp {{ number_format($item['quantity'] * $item['menu']->harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-4 text-right">
            <h2 class="text-lg font-semibold">Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h2>
        </div>

        <button wire:click="createOrder" class="bg-blue-500 text-white px-4 py-2 rounded">
            Open Bill
        </button>
    @endif
</div>
