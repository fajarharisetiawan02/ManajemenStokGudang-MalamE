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

        if ($username == 'admin' && $password == 'admin123') {

            session([
                'login' => true,
                'role' => 'admin',
                'username' => $username
            ]);

            return redirect('/dashboard');
        }

        if ($username == 'manager' && $password == 'manager123') {

            session([
                'login' => true,
                'role' => 'manager',
                'username' => $username
            ]);

            return redirect('/dashboardmanager');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}