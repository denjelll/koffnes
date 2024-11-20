<form action="{{ route('admin.update.menu') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
    <label for="nama">Nama Menu :</label>
    <input type="text" name="nama_menu" id="nama" value="{{ $menu->nama_menu }}">
    <br>
    <label for="harga">Harga :</label>
    <input type="number" name="harga" id="harga" value="{{ $menu->harga }}">
    <br>
    <label for="deskripsi">Deskripsi :</label>
    <textarea name="deskripsi" id="deskripsi">{{ $menu->deskripsi }}</textarea>
    <br>
    <label for="stok">Stok :</label>
    <input type="number" name="stok" id="stok" value="{{ $menu->stock }}">
    <br>
    @if(isset($addons))
    @foreach ($addons as $addon)
        <input type="hidden" name="id_addon[]" value="{{ $addon->id_addon }}">
        <input type="text" name="addOns[]" value="{{ $addon->nama_addon }}">
        <br>
        <input type="number" name="harga_addon[]" value="{{$addon->harga}}">
        <br>
    @endforeach
    @endif
        @if(!isset($addons) || count($addons) == 0)
        <button type="button" onclick="addAddOns()">Tambah Addon</button>
            <div id="addOns">
            </div>
        @endif

    <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
    <div>
        <img id="featured_image_preview" class="h-64 w-128 object-cover rounded-md" src="{{asset('menu/'.$menu->gambar)}}" alt="Featured image preview" />
    </div>
    <br>
    
    <button type="submit">Edit Menu</button>
    </form>
    <script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('featured_image_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // Set the image source to the file's data URL
            }
            reader.readAsDataURL(file); // Read the file as a data URL
        } 
    }
    function addAddOns() {
            const AddOns = document.getElementById('addOns');
            AddOns.innerHTML += `
                <input type="text" name="addOns[]" placeholder="Add-Ons"><br>
                <input type="text" name="harga_addon[]" placeholder="Harga"><br>
            `;
        }
</script>