<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // ADMIN
        if ($username == 'admin' && $password == 'admin123') {

            $request->session()->put('login', true);
            $request->session()->put('role', 'admin');
            $request->session()->save();

            return redirect('/admin/dashboard');
        }

        // MANAGER
        if ($username == 'manager' && $password == 'manager123') {

            $request->session()->put('login', true);
            $request->session()->put('role', 'manager');
            $request->session()->save();

            return redirect('/manager/dashboard');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout(Request $request)
    {
        // Hapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}