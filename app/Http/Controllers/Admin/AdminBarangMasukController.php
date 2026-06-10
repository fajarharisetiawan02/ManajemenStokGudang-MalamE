<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminBarangMasukController extends Controller
{
public function index()
    {
    $barangMasuks = BarangMasuk::with([
        'barang',
        'supplier'
    ])
    ->latest()
    ->paginate(10);

    $barangs = Barang::all();
    $suppliers = Supplier::all();

    return view(
        'pages.admin.barang-masuk',
        compact(
            'barangMasuks',
            'barangs',
            'suppliers'
        )
    );
    }

public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'supplier_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        $total = $request->jumlah * $request->harga_beli;

        // simpan transaksi masuk
        BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_beli' => $request->harga_beli,
            'total' => $total,
        ]);

        // update stok
        $barang->stok += $request->jumlah;
        $barang->save();

        return back()->with('success', 'Barang masuk berhasil');
    }

public function update(Request $request, BarangMasuk $barang_masuk)
    {
    $request->validate([
        'supplier_id' => 'required|exists:suppliers,id',
        'jumlah' => 'required|integer|min:1',
        'harga_beli' => 'required|numeric|min:0',
    ]);

    $barang = Barang::findOrFail($barang_masuk->barang_id);

    // rollback stok lama
    $barang->stok -= $barang_masuk->jumlah;

    // tambah stok baru
    $barang->stok += $request->jumlah;

    $barang->save();

    $barang_masuk->update([
        'supplier_id' => $request->supplier_id,
        'jumlah' => $request->jumlah,
        'harga_beli' => $request->harga_beli,
        'total' => $request->jumlah * $request->harga_beli,
    ]);

    return back()->with(
        'success',
        'Data barang masuk berhasil diperbarui'
    );
    }

public function destroy(BarangMasuk $barang_masuk)
    {
    $barang = Barang::findOrFail(
        $barang_masuk->barang_id
    );

    // kembalikan stok
    $barang->stok -= $barang_masuk->jumlah;
    $barang->save();

    $barang_masuk->delete();

    return back()->with(
        'success',
        'Data berhasil dihapus'
    );
    }
}
