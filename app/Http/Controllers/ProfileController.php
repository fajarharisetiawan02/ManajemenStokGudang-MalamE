<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN PROFIL
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('pages.profile', [
            'user' => Auth::user()
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL (name, username, email)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'email'    => ['required', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
        ], [
            'name.required'     => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username sudah digunakan.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah digunakan.',
        ]);

        $user->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | UBAH PASSWORD
    |--------------------------------------------------------------------------
    */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama'  => 'required',
            'password_baru'  => 'required|min:8|confirmed',
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.min'      => 'Password baru minimal 8 karakter.',
            'password_baru.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->update([
            'password' => Hash::make($request->password_baru),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}