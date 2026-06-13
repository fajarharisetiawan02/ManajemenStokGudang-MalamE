<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class ManagerBarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangMasuk::with([
            'barang.kategori',
            'barang.brand',
            'supplier'
        ])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        $barangMasuks = $query->paginate(10)->withQueryString();

        return view('pages.manager.barang-masuk', compact('barangMasuks'));
    }
}