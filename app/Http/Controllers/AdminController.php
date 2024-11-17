<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;
use App\Models\KategoriAddOn;
use App\Models\DetailAddOn;

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
        $imageName = time() . '_' . $image->getClientOriginalName();

        

        $menu = new Menu();
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;
        $menu->stock = $request->stok;
        $menu->gambar = $imageName;
        if(isset($request->harga_promo)){
            $promo = new Promo();
            $promo->harga_promo = $request->harga_promo;
            $waktu_mulai_date = $request->waktu_mulai_date;
            $waktu_mulai_time = $request->waktu_mulai_time;
            $waktu_mulai = $waktu_mulai_date . ' ' . $waktu_mulai_time;
            $promo->waktu_mulai = $waktu_mulai;
            $waktu_selesai_date = $request->waktu_selesai_date;
            $waktu_selesai_time = $request->waktu_selesai_time;
            $waktu_selesai = $waktu_selesai_date . ' ' . $waktu_selesai_time;
            $promo->waktu_berakhir = $waktu_selesai;
            $promo->save();
            $promo = Promo::latest()->first();
            $menu->id_promo = $promo->id_promo;
        }
        
        $menu->save();
        $image->move(public_path('menu'), $imageName);

        


        return redirect('/admin/menu');
    }

    public function showEditMenuForm(Menu $menu){
        return view('admin.edit_menu', compact('menu'));
    }
    public function DeleteMenu($id){
        $menu = Menu::find($id);
        $menu->delete();
        unlink(public_path('menu/'.$menu->gambar));
        return redirect('/admin/menu');
    }
    public function updateMenu(Request $request){
        $request->validate([
            'harga' => 'numeric',
            'stok' => 'numeric',
        ]);
        $menu = Menu::find($request->id_menu);

    if ($request->hasFile('gambar')) {
        $image = $request->file('gambar');
        $imageName = time() . '_' . $image->getClientOriginalName();
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

    return redirect('/admin/menu')->with('success', 'Menu updated successfully');
    }
}
