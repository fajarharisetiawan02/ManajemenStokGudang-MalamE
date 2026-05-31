<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class AdminBarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluars = BarangKeluar::with('barang')->latest()->get();

        $barangs = Barang::all();

        return view('pages.admin.barang-keluar', compact(
            'barangKeluars',
            'barangs'
        ));
    }

    public function store(Request $request)
    {
        // nanti logika stok keluar
    }
}