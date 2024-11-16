<!-- Daftar Item di Keranjang -->
<h2>Checkout - Isi Keranjang Anda:</h2>
<pre>{{ print_r($cart, true) }}</pre>
@foreach ($cart as $menuId => $quantity)
    <div>
        <p>Menu ID: {{ $menuId }}, Quantity: {{ $quantity }}</p>
    </div>
@endforeach
