<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function verify(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        
        if ($user && Hash::check($password, $user->password)) {
            Session::put('id_user', $user->id_user);
            Session::put('nama', $user->nama_depan . ' ' . $user->nama_belakang);
            Session::put('role', $user->role);
            if ($user->role == 'Admin') {
                return redirect('/admin/menu');
            } else if ($user->role == 'Kasir') {
                return redirect('/cashier');
            }
        } else {
            return redirect('/login')->with('error', 'Email atau password salah');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
