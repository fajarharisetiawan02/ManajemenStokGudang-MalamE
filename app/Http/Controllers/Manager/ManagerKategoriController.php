<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ManagerKategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::withCount('barang')->orderBy('nama_kategori', 'ASC');

        if ($request->filled('search')) {
            $query->where('id', $request->search);
        }

        $kategori = $query->get();

        return view('pages.manager.kategori', compact('kategori'));
    }
}