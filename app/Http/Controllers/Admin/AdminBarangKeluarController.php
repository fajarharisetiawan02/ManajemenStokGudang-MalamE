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
        $query = BarangKeluar::with(['barang.kategori', 'barang.brand'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
            })->orWhere('tujuan', 'like', "%{$search}%");
        }

        $barangKeluars = $query->paginate(10)->withQueryString();
        $barangs       = Barang::orderBy('nama_barang', 'ASC')->get();

        return view('pages.admin.barang-keluar', compact('barangKeluars', 'barangs'));
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
            'barang_id'  => 'required|exists:barangs,id',
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|integer|min:1',
            'harga_jual' => 'required|numeric|min:0',
            'tujuan'     => 'nullable|string|max:255',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok barang tidak mencukupi');
        }

        BarangKeluar::create([
            'barang_id'  => $request->barang_id,
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'total'      => $request->jumlah * $request->harga_jual,
            'tujuan'     => $request->tujuan,
        ]);

        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()
            ->route('admin.barang-keluar.index')
            ->with('success', 'tambah');
    }

    public function update(Request $request, BarangKeluar $barang_keluar)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|integer|min:1',
            'harga_jual' => 'required|numeric|min:0',
            'tujuan'     => 'nullable|string|max:255',
        ]);

        $barang = Barang::findOrFail($barang_keluar->barang_id);

        $stokSetelahRollback = $barang->stok + $barang_keluar->jumlah;

        if ($stokSetelahRollback < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $barang->stok = $stokSetelahRollback - $request->jumlah;
        $barang->save();

        $barang_keluar->update([
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'total'      => $request->jumlah * $request->harga_jual,
            'tujuan'     => $request->tujuan,
        ]);

        return back()->with('success', 'update');
    }

    public function destroy(BarangKeluar $barang_keluar)
    {
        $barang = Barang::findOrFail($barang_keluar->barang_id);

        $barang->stok += $barang_keluar->jumlah;
        $barang->save();

        $barang_keluar->delete();

        return back()->with('success', 'delete');
    }
}