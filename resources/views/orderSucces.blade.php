<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Succesful : {{ $id_order  }}</title>
</head>
<body>
    <div class="container mx-auto my-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center">Order Successful!</h1>
            <p class="text-center mt-4">Thank you for your order.</p>
            <p class="text-center mt-2">Your Order ID is: <strong>{{ $id_order }}</strong></p>
            <div class="text-center mt-6">
                <a href="{{ route('order.menu', ['nomorMeja' => session('meja')]) }}" class="btn btn-primary">Back to Menu</a>
            </div>
        </div>
    </div>
</body>
</html>