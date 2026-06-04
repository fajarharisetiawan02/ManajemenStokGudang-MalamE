<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class AdminBarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangKeluar::with('barang')->latest();

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('barang', function ($q) use ($search) {

                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");

            });

        }

        $barangKeluars = $query
            ->paginate(10)
            ->withQueryString();

        $barangs = Barang::orderBy('nama_barang', 'ASC')->get();

        return view(
            'pages.admin.barang-keluar',
            compact(
                'barangKeluars',
                'barangs'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'  => 'required|exists:barangs,id',
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|integer|min:1',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {

            return back()->with(
                'error',
                'Stok barang tidak mencukupi'
            );

        }

        BarangKeluar::create([
            'barang_id'  => $request->barang_id,
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'total'      => $request->jumlah * $request->harga_jual,
        ]);

        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()
            ->route('admin.barang-keluar.index')
            ->with(
                'success',
                'Barang keluar berhasil ditambahkan'
            );
    }
}