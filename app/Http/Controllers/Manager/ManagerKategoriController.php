<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Kategori;

class ManagerKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('barang')
            ->orderBy('nama_kategori', 'ASC')
            ->get();

        return view('pages.manager.kategori', compact('kategori'));
    }
}