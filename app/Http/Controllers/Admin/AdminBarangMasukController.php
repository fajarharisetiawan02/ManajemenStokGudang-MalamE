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
            'barang.kategori',
            'barang.brand',
            'supplier'
        ])
        ->latest()
        ->paginate(10);

        $barangs   = Barang::all();
        $suppliers = Supplier::all();

        return view(
            'pages.admin.barang-masuk',
            compact('barangMasuks', 'barangs', 'suppliers')
        );
    }

    public function cekBarang($kode)
    {
        $barang = Barang::with(['kategori', 'brand'])
            ->where('kode', $kode)
            ->first();

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id'          => $barang->id,
                'kode'        => $barang->kode,
                'nama_barang' => $barang->nama_barang,
                'kategori'    => optional($barang->kategori)->nama_kategori,
                'brand'       => optional($barang->brand)->nama_brand ?? $barang->brand,
                'tipe'        => $barang->tipe ?? '-',
                'stok'        => $barang->stok,
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'   => 'required|exists:barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|integer|min:1',
            'harga_beli'  => 'required|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        BarangMasuk::create([
            'barang_id'   => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'tanggal'     => $request->tanggal,
            'jumlah'      => $request->jumlah,
            'harga_beli'  => $request->harga_beli,
            'total'       => $request->jumlah * $request->harga_beli,
        ]);

        $barang->stok += $request->jumlah;
        $barang->save();

        return back()->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function update(Request $request, BarangMasuk $barang_masuk)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah'      => 'required|integer|min:1',
            'harga_beli'  => 'required|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($barang_masuk->barang_id);

        $barang->stok = $barang->stok - $barang_masuk->jumlah + $request->jumlah;
        $barang->save();

        $barang_masuk->update([
            'tanggal'     => $request->tanggal,
            'supplier_id' => $request->supplier_id,
            'jumlah'      => $request->jumlah,
            'harga_beli'  => $request->harga_beli,
            'total'       => $request->jumlah * $request->harga_beli,
        ]);

        return back()->with('success', 'Data barang masuk berhasil diperbarui.');
    }

    public function destroy(BarangMasuk $barang_masuk)
    {
        $barang = Barang::findOrFail($barang_masuk->barang_id);

        $barang->stok -= $barang_masuk->jumlah;
        $barang->save();

        $barang_masuk->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}