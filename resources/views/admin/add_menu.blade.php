<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="nama">Nama Menu :</label>
        <input type="text" name="nama_menu" id="nama">
        <br>
        <label for="harga">Harga :</label>
        <input type="number" name="harga" id="harga">
        <br>
        <label for="deskripsi">Deskripsi :</label>
        <textarea name="deskripsi" id="deskripsi"></textarea>
        <br>
        <label for="stok">Stok :</label>
        <input type="number" name="stok" id="stok">
        <br>
        <label for="gambar">Gambar :</label>
        <input type="file" name="gambar" id="gambar">
        <br>
        <button type="submit">Add Menu</button>
    </form>
</body>
</html>