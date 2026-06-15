<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class ManagerBarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangKeluar::with(['barang.kategori', 'barang.brand'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
            })->orWhere('tujuan', 'like', "%{$search}%");
        }

        $barangKeluars = $query->paginate(10)->withQueryString();

        return view('pages.manager.barang-keluar', compact('barangKeluars'));
    }
}