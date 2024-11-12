<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;

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
            'kategori' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $image = $request->file('gambar');
        $imageName = time().'.'.$image->getClientOriginalName();
        $image->move(public_path('menu'), $imageName);

        $menu = new Menu();
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->id_kategoridetail = 1;
        $menu->deskripsi = $request->deskripsi;
        $menu->stock = $request->stok;
        $menu->gambar = $imageName;
        $menu->save();
        

        return redirect('/admin/menu');
    }

    public function showEditMenuForm($id){
        $menu = Menu::find($id);
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
        if($request->hasFile('gambar')){
            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('menu'), $imageName);
            $menu = Menu::find($request->id_menu);
            unlink(public_path('menu/'.$menu->gambar));
            $menu->gambar = $imageName;
        }

        $menu = Menu::find($request->id_menu);
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->id_kategoridetail = 1;
        $menu->deskripsi = $request->deskripsi;
        $menu->stock = $request->stok;
        $menu->save();
        

        return redirect('/admin/menu');
    }
}
