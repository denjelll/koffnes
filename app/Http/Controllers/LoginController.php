<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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

        $user = DB::table('users')->where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Session::put('id_user', $user->id_user);
            Session::put('nama', $user->nama_depan);
            Session::put('role', $user->role);
            return redirect('/admin');
        } else {
            return redirect('/login');
        }
    }
}
