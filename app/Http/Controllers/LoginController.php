<?php

<<<<<<< HEAD
=======
// Nama : Farhan Mansyuri
// NIM  : 3312511141
>>>>>>> 9e300dc63da50658d462d9cd23494f57b31cbdfc
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Ambil input dari form
        $username = $request->input('username');
        $password = $request->input('password');

<<<<<<< HEAD
        // Akun default
=======
>>>>>>> 9e300dc63da50658d462d9cd23494f57b31cbdfc
        $user = [
            'username' => 'admin',
            'password' => '12345'
        ];

        // Cek login
        if ($username === $user['username'] && $password === $user['password']) {
            return redirect()->route('dashboard');
        }

        // Jika login gagal
        return redirect()->route('login')->with('error', 'Username atau Password salah!');
    }
}