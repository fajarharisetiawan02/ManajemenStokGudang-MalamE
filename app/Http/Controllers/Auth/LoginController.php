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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->remember)) {

            // Simpan locale sebelum regenerate
            $locale = $request->session()->get('locale', 'id');

            $request->session()->regenerate();

            // Restore locale setelah regenerate
            $request->session()->put('locale', $locale);

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'manager') {
                return redirect()->route('manager.dashboard');
            }

            Auth::logout();
            return redirect('/login')->with('error', 'Role tidak dikenali!');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout(Request $request)
    {
        // Simpan locale sebelum session di-clear
        $locale = $request->session()->get('locale', 'id');

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Restore locale setelah session baru dibuat
        $request->session()->put('locale', $locale);

        return redirect('/login');
    }
}