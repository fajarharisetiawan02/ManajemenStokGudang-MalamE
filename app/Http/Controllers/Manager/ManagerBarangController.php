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
        ]);

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%");

            });
        }

        // FILTER KATEGORI
        if ($request->filled('kategori_id')) {

            $query->where(
                'kategori_id',
                $request->kategori_id
            );

        }

        // FILTER BRAND
        if ($request->filled('brand')) {

            $query->whereHas('brand', function ($q) use ($request) {

                $q->where(
                    'nama_brand',
                    $request->brand
                );

            });
        }

        // SHOW ENTRIES
        $perPage = (int) $request->get('per_page', 10);

        $allowedPerPage = [10, 25, 50];

        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $barangs = $query
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $kategori = Kategori::orderBy('nama_kategori')->get();

        $supplier = Supplier::orderBy('nama_supplier')->get();

        $brandOptions = Brand::orderBy('nama_brand')->get();

        return view(
            'pages.manager.data-barang',
            compact(
                'barangs',
                'kategori',
                'supplier',
                'brandOptions'
            )
        );
    }

    public function show($id)
    {
        $barang = Barang::with([
            'kategori',
            'supplier',
            'brand',
            'gambarBarang'
        ])->findOrFail($id);

        return view(
            'pages.manager.detail-barang',
            compact('barang')
        );
    }
}