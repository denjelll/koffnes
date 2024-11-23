<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;
use App\Models\AddOn;
use App\Models\Kategori;
use App\Models\Isi_kategori;
use App\Models\User;
use App\Models\Event;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        if (Session::get('role') == 'Admin') {
            return view('admin.index');
        } else {
            return redirect('/login');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function menu(){
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }

    public function showAddMenuForm(){
        return view('admin.add_menu');
    }

    public function storeMenu(Request $request){
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $image = $request->file('gambar');
        $now = date('jmYHis');
        $imageName = $now . '_' . $image->getClientOriginalName();

        if(isset($request->harga_promo)){
            $promo = new Promo();
            $promo->judul_promo = $request->judul_promo;
            $promo->harga_promo = $request->harga_promo;
            $promo->hari = $request->hari;
            $promo->waktu_mulai = $request->waktu_mulai;
            $promo->waktu_berakhir = $request->waktu_berakhir;
            $promo->save();
        }

        $menu = new Menu();
        $menu->nama_menu = $request->nama_menu;
        if(isset($request->harga_promo)){
            $promo = Promo::latest()->first();
            $menu->id_promo = $promo->id_promo;
        }
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;
        $menu->stock = $request->stok;
        $menu->gambar = $imageName;        
        $menu->save();

        if(isset($request->addOns)){
            $menu = Menu::latest()->first();
            foreach($request->addOns as $index => $addOn){
                $AddOn = new AddOn();
                $AddOn->id_menu = $menu->id_menu;
                $AddOn->nama_addon = $addOn;
                $AddOn->harga = $request->harga_addon[$index];
                $AddOn->save();
            }
        }

        

        $image->move(public_path('menu'), $imageName);


        


        return redirect('/admin/menu');
    }

    public function showEditMenuForm(Menu $menu){
        $addons = AddOn::where('id_menu', $menu->id_menu)->get();
        return view('admin.edit_menu', compact('menu', 'addons'));
    }
    public function DeleteMenu($id){
        $menu = Menu::find($id);
        $menu->delete();
        unlink(public_path('menu/'.$menu->gambar));
        return redirect('/admin/menu');
    }

    public function promo(){
        $promos = Promo::all();
        return view('admin.promo', compact('promos'));
    }

    public function showAddPromoForm(){
        $menus = Menu::where('id_promo', null)->get();
        return view('admin.add_promo', compact('menus'));
    }
    public function showEditPromoForm(Promo $promo){
        return view('admin.edit_promo', compact('promo'));
    }
    public function storePromo(Request $request){
        $request->validate([
            'judul_promo' => 'required',
            'harga_promo' => 'required|numeric',
            'product' => 'required',
            'hari'=> 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);

        $promo = new Promo();
        $promo->judul_promo = $request->judul_promo;
        $promo->harga_promo = $request->harga_promo;
        $promo->hari = $request->hari;
        $promo->waktu_mulai = $request->waktu_mulai;
        $promo->waktu_berakhir = $request->waktu_berakhir;
        $promo->save();

        $promo = Promo::latest()->first();
        $menu = Menu::find($request->product);
        $menu->id_promo = $promo->id_promo;
        $menu->save();

        return redirect('/admin/promo');
    }
    public function updatePromo(Request $request){
        $request->validate([
            'judul_promo' => 'required',
            'harga_promo' => 'required|numeric',
            'hari'=> 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);
        $promo = Promo::find($request->id_promo);
        $promo->judul_promo = $request->judul_promo;
        $promo->harga_promo = $request->harga_promo;
        $promo->hari = $request->hari;
        $promo->waktu_mulai = $request->waktu_mulai;
        $promo->waktu_berakhir = $request->waktu_berakhir;
        $promo->save();
        return redirect('/admin/promo');
    }
    public function deletePromo(Promo $promo){
        $promo->delete();
        return redirect('/admin/promo');
    }
    public function updateMenu(Request $request){
        $request->validate([
            'harga' => 'numeric',
            'stok' => 'numeric',
        ]);
        $menu = Menu::find($request->id_menu);

    if ($request->hasFile('gambar')) {
        $now = date('jmYHis');
        $image = $request->file('gambar');
        $imageName = $now . '_' . $image->getClientOriginalName();
        $image->move(public_path('menu'), $imageName);

        // Hapus gambar lama setelah gambar baru disimpan
        if ($menu->gambar && file_exists(public_path('menu/' . $menu->gambar))) {
            unlink(public_path('menu/' . $menu->gambar));
        }

        // Perbarui kolom gambar di database
        $menu->gambar = $imageName;
    }

    // Perbarui kolom lainnya
    $menu->nama_menu = $request->nama_menu;
    $menu->harga = $request->harga;
    $menu->stock = $request->stok;
    $menu->deskripsi = $request->deskripsi;
    $menu->save();
    if(isset($request->addOns)){
        $menu = Menu::find($request->id_menu);
        foreach($request->addOns as $index => $addOn){
            if(!isset($request->id_addon[$index])){
            $AddOn = new AddOn();
            }else{
                $AddOn = AddOn::find($request->id_addon[$index]);
            }
            $AddOn->id_menu = $menu->id_menu;
            $AddOn->nama_addon = $addOn;
            $AddOn->harga = $request->harga_addon[$index];
            $AddOn->save();
        }
    }
    return redirect('/admin/menu')->with('success', 'Menu updated successfully');
    }

    public function kategori(){
        $kategoris = Kategori::all();
        $isi_kategoris = Isi_kategori::groupBy('id_kategori')->count();
        return view('admin.kategori',compact('kategoris','isi_kategoris'));
    }
    public function showAddKategoriForm(){
        $menus = Menu::all();
        return view('admin.add_kategori',compact('menus'));
    }
    public function storeKategori(Request $request){
        $request->validate([
            'nama_kategori' => 'required',
            'menu' => 'required'
        ]);
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        $kategori = Kategori::latest()->first();
        foreach($request->menu as $menu){
            $isi_kategori = new Isi_kategori();
            $isi_kategori->id_kategori = $kategori->id_kategori;
            $isi_kategori->id_menu = $menu;
            $isi_kategori->save();
        }
        return redirect('/admin/kategori');
    }
    public function showEditKategoriForm(Kategori $kategori){
        $menus = Menu::all();
        $isi_kategoris = Isi_kategori::where('id_kategori',$kategori->id_kategori)->get();
        return view('admin.edit_kategori',compact('kategori','menus','isi_kategoris'));
    }
    public function updateKategori(Request $request){
        $request->validate([
            'nama_kategori' => 'required',
            'menu' => 'required'
        ]);
        $kategori = Kategori::find($request->id_kategori);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        Isi_kategori::where('id_kategori',$request->id_kategori)->delete();
        foreach($request->menu as $menu){
            $isi_kategori = new Isi_kategori();
            $isi_kategori->id_kategori = $request->id_kategori;
            $isi_kategori->id_menu = $menu;
            $isi_kategori->save();
        }
        return redirect('/admin/kategori');
    }
    public function deleteKategori(Kategori $kategori){
        $kategori->delete();
        Isi_kategori::where('id_kategori',$kategori->id_kategori)->delete();
        return redirect('/admin/kategori');
    }
    public function user(){
        $users = User::all();
        return view('admin.user', compact('users'));
    }
    public function showAddUserForm(){
        return view('admin.add_user');
    }
    public function storeUser(Request $request){
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);
        if($request->password != $request->password_confirmation){
            return redirect()->back()->with('error', 'Password confirmation does not match');
        }
        $user = new User();
        
        $user->nama_depan = $request->nama_depan;
        $user->nama_belakang = $request->nama_belakang;
        $user->no_telepon = $request->no_telepon;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect('/admin/user');
    }
    public function showEditUserForm(User $user){
        return view('admin.edit_user', compact('user'));
    }
    public function updateUser(Request $request){
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);
        if($request->password){
            if($request->password != $request->password_confirmation){
                return redirect()->back()->with('error', 'Password confirmation does not match');
            }
        }
        $user = User::find($request->id_user);
        $user->nama_depan = $request->nama_depan;
        $user->nama_belakang = $request->nama_belakang;
        $user->no_telepon = $request->no_telepon;
        $user->email = $request->email;
        $user->role = $request->role;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('/admin/user')->with('success', 'User updated successfully');
    }
    public function deleteUser(User $user){
        $user->delete();
        return redirect('/admin/user');
    }
    public function event(){
        $events = Event::all();
        return view('admin.event', compact('events'));

    }
    public function showAddEventForm(){
        return view('admin.add_event');
    }
    public function storeEvent(Request $request){
        $request->validate([
            'nama_event' => 'required',
            'tanggal_event' => 'required',
            'jam_event' => 'required',
            'hadiah' => 'required',
            'banner_event' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'deskripsi_event' => 'required'
        ]);
        $image = $request->file('banner_event');
        $now = date('jmYHis');
        $imageName = $now . '_' . $image->getClientOriginalName();
        $event = new Event();
        $event->nama_event = $request->nama_event;
        $event->tanggal_event = $request->tanggal_event;
        $event->banner_event = $imageName;
        $event->hadiah_event = $request->hadiah;
        $event->jam_event = $request->jam_event;
        $event->deskripsi_event = $request->deskripsi_event;
        $event->save();
        $image->move(public_path('event'), $imageName);
        return redirect('/admin/event');
    }
    public function showEditEventForm(Event $event){
        return view('admin.edit_event', compact('event'));
    }
    public function updateEvent(Request $request){
        $request->validate([
            'nama_event' => 'required',
            'tanggal_event' => 'required',
            'jam_event' => 'required',
            'hadiah' => 'required',
            'deskripsi_event' => 'required'
        ]);
        $event = Event::find($request->id_event);
        $event->nama_event = $request->nama_event;
        $event->tanggal_event = $request->tanggal_event;
        $event->jam_event = $request->jam_event;
        $event->hadiah_event = $request->hadiah;
        $event->deskripsi_event = $request->deskripsi_event;
        if ($request->hasFile('banner_event')) {
            $image = $request->file('banner_event');
            $now = date('jmYHis');
            $imageName = $now . '_' . $image->getClientOriginalName();
            $image->move(public_path('event'), $imageName);
    
            // Hapus gambar lama setelah gambar baru disimpan
            if ($event->banner_event && file_exists(public_path('event/' . $event->banner_event))) {
                unlink(public_path('event/' . $event->banner_event));
            }
    
            // Perbarui kolom gambar di database
            $event->banner_event = $imageName;
        }
        $event->save();
        return redirect('/admin/event')->with('success', 'Event updated successfully');
    }
    public function deleteEvent(Event $event){
        $event->delete();
        unlink(public_path('event/'.$event->banner_event));
        return redirect('/admin/event');
    }
    public function updatePromoStatus(Request $request, $id)
{
    $promo = Promo::find($id);
    if ($promo) {
        $promo->status = $request->status;
        $promo->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}
    public function transaction(){
        $orders = Order::all();
        $orders = Order::selectRaw('DATE(waktu_transaksi) as date, SUM(total_harga) as total_harga')
            ->groupBy('date')
            ->get();
        return view('admin.transaction', compact('orders'));
    }
    public function transactionDate($date){
        $orders = Order::whereDate('waktu_transaksi', $date)->get();
        return view('admin.transaction_date', compact('orders'));
    }
    public function transactionDetail(Order $order){
        return view('admin.detail_transaksi', compact('order'));
    }
}
