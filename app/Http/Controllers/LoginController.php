<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == 'admin' && $password == 'admin123') {

            session([
                'login' => true,
                'username' => $username
            ]);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}