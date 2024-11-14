<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Form Meja</title>
</head>
<body>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Masukkan Nama dan Nomor Meja</h2>
        <form action="{{ url('/order/meja/' . $nomorMeja) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block">Nomor Meja</label>
                <input type="text" value="{{ $nomorMeja }}" disabled class="input input-bordered w-full">
            </div>
            <div>
                <label class="block">Nama Customer</label>
                <input type="text" name="nama_customer" required class="input input-bordered w-full">
            </div>
            <button type="submit" class="btn btn-primary w-full">Lanjutkan</button>
        </form>
    </div>
</body>
</html>