<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\BarangGambar;
use Illuminate\Http\Request;

class AdminBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'supplier', 'brand'])->latest();

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
        $brandOptions = Brand::all();

        return view('pages.admin.data-barang', compact(
            'barangs',
            'kategori',
            'brandOptions'
        ));
    }

    public function show($id)
    {
        $barang = Barang::with(['kategori', 'supplier', 'brand', 'gambarBarang'])->findOrFail($id);
        return view('pages.admin.detail-barang', compact('barang'));
    }

    public function create()
    {
        return redirect()->route('admin.data-barang.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'        => 'required|unique:barangs,kode',
            'nama_barang' => 'required',
            'harga_jual'  => 'required|numeric',
            'gambar.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $barang = Barang::create([
            'kode'        => $request->kode,
            'nama_barang' => $request->nama_barang,
            'stok'        => 0, // default 0, dikelola dari Barang Masuk
            'harga_beli'  => $request->harga_beli ?? 0,
            'harga_jual'  => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => null,
            'brand_id'    => $request->brand_id,
            'deskripsi'   => $request->deskripsi,
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $namaFile = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/barang'), $namaFile);
                BarangGambar::create([
                    'barang_id' => $barang->id,
                    'gambar'    => $namaFile,
                ]);
            }
        }

        return redirect()->route('admin.data-barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode'        => 'required|unique:barangs,kode,' . $id,
            'nama_barang' => 'required',
            'harga_jual'  => 'required|numeric',
            'gambar.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $barang->update([
            'kode'        => $request->kode,
            'nama_barang' => $request->nama_barang,
            'harga_beli'  => $request->harga_beli ?? 0,
            'harga_jual'  => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
            'brand_id'    => $request->brand_id,
            'deskripsi'   => $request->deskripsi,
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($barang->gambarBarang as $gambar) {
                if (file_exists(public_path('uploads/barang/' . $gambar->gambar))) {
                    unlink(public_path('uploads/barang/' . $gambar->gambar));
                }
                $gambar->delete();
            }
            foreach ($request->file('gambar') as $file) {
                $namaFile = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/barang'), $namaFile);
                BarangGambar::create([
                    'barang_id' => $barang->id,
                    'gambar'    => $namaFile,
                ]);
            }
        }

        return redirect()->route('admin.data-barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::with('gambarBarang')->findOrFail($id);

        foreach ($barang->gambarBarang as $gambar) {
            if (file_exists(public_path('uploads/barang/' . $gambar->gambar))) {
                unlink(public_path('uploads/barang/' . $gambar->gambar));
            }
        }

        $barang->delete();

        return redirect()->route('admin.data-barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}