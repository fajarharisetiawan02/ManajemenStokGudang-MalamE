<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // DATA DUMMY (TANPA DATABASE)
        $kategori = [
            (object)['nama' => 'Oli Mesin', 'barang_count' => 20],
            (object)['nama' => 'Ban Mobil', 'barang_count' => 10],
            (object)['nama' => 'Aki', 'barang_count' => 5],
            (object)['nama' => 'Kampas Rem', 'barang_count' => 12],
        ];

        return view('pages.admin.kategori', compact('kategori'));
    }
}