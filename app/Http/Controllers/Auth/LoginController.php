<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        // VALIDASI
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // CEK LOGIN
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // LOGIN BERHASIL
        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            // AMBIL DATA USER
            $user = Auth::user();

            // ROLE ADMIN
            if ($user->role === 'admin') {

                return redirect()
                    ->route('admin.dashboard');

            }

            // ROLE MANAGER
            if ($user->role === 'manager') {

                return redirect()
                    ->route('manager.dashboard');

            }

            // DEFAULT
            Auth::logout();

            return redirect('/login')
                ->with('error', 'Role tidak dikenali!');
        }

        // LOGIN GAGAL
        return back()
            ->with('error', 'Username atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}