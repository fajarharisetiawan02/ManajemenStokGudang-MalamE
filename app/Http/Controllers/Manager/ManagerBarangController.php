<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Brand;
use Illuminate\Http\Request;

class ManagerBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with([
            'kategori',
            'supplier',
            'brand'
        ])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        if ($request->filled('brand')) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('nama_brand', $request->brand);
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('stok')) {
            if ($request->stok === 'menipis') {
                $query->where('stok', '>', 0)->where('stok', '<=', 10);
            } elseif ($request->stok === 'habis') {
                $query->where('stok', '<=', 0);
            } elseif ($request->stok === 'kritis') {
                $query->where('stok', '>', 0)->where('stok', '<=', 5);
            }
        }

        $perPage = (int) $request->input('per_page', 10);
        $barangs = $query->paginate($perPage)->withQueryString();

        $kategori     = Kategori::all();
        $supplier     = Supplier::all();
        $brandOptions = Brand::all();

        return view('pages.manager.data-barang', compact(
            'barangs',
            'kategori',
            'supplier',
            'brandOptions'
        ));
    }

    public function show($id)
    {
        $barang = Barang::with([
            'kategori',
            'supplier',
            'brand',
            'gambarBarang'
        ])->findOrFail($id);

        return view('pages.manager.detail-barang', compact('barang'));
    }
}