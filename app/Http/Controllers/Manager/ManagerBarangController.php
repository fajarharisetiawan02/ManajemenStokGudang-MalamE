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
        $query = Barang::with(['kategori', 'supplier']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('no_part', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        $perPage = (int) $request->get('per_page', 10);
        $allowedPerPage = [10, 25, 50];

        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $barang = $query->latest()->paginate($perPage)->withQueryString();
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        $brandOptions = Brand::all();

        return view('pages.manager.data-barang', compact(
            'barang',
            'kategori',
            'supplier',
            'brandOptions'
        ));
    }
}