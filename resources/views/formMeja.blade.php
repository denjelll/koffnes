<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('storage/asset/gambar/icon.png') }}">
    @vite('resources/css/app.css')
    <style>
        body {
          background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
          background-repeat: repeat;
          background-position: top left;
          background-size: 400px 400px;
          padding-bottom: 64px;
          padding-top: 60px;
          margin: 0;
        }
      </style>
    <title>Form Meja</title>
</head>
<body class="flex items-center justify-center min-h-screen flex-col">
    <img src="{{ asset('storage/asset/gambar/koffnes.png') }}" alt="Koffnes Logo" class="mb-2" style="width: 250px; height: auto;"/>

    <div class="bg-white p-6 shadow-lg w-80 mb-10" style="background-color: #fff2e2; border: solid 5px #412f26; border-radius: 10px;">
      <h2 class="text-2xl font-semibold text-center">
        Masukan Nama Kamu
      </h2>
        
        <form action="{{ route('order.saveCustomer', ['nomorMeja' => $nomorMeja]) }}" method="POST">
            @csrf
            <div>
                <label for="nama" class="font-bold text-gray-700" style="font-family: helvetica;">
                    Nama</label>
                <input 
                type="text"
                id="nama" 
                name="nama_customer" 
                required 
                autocomplete="off"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md"
                placeholder="Ketikan Namamu">
            </div>

            <!-- Input No Table -->
            <div>
                <label for="no-table" class="font-bold text-sm font-medium text-gray-700" style="font-family: helvetica;">
                Nomor Meja</label>
                <input 
                type="text"
                id="no-table"
                value="{{ $nomorMeja }}" 
                disabled 
                class="w-full p-2 mt-1 border border-gray-300 rounded-md">
            </div>

            <!-- Tombol Confirm -->
            <div class="flex justify-center mt-6">
                <button
                  type="submit"
                  class="text-white w-50 px-4 font-bold py-2 focus:outline-none focus:ring-2" style="background-color: #412f26; font-family: helvetica; border-radius: 10px; font-size: 135%;">
                 Gasss!!
                </button>
              </div>
        </form>
    </div>
</body>
</html>