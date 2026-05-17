<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBarangController extends Controller
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

        return view('pages.admin.data-barang', compact(
            'barang',
            'kategori',
            'supplier',
            'brandOptions'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_part' => 'required|unique:barang,no_part',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'brand' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'supplier_id' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambar = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $gambar);
        }

        Barang::create([
            'no_part' => $validated['no_part'],
            'nama_barang' => $validated['nama_barang'],
            'kategori_id' => $validated['kategori_id'],
            'brand' => $validated['brand'],
            'stok' => $validated['stok'],
            'harga' => $validated['harga'],
            'gambar' => $gambar,
            'supplier_id' => $validated['supplier_id'],
        ]);

        return redirect()
            ->route('admin.data-barang.index')
            ->with('success', 'Data barang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'no_part' => 'required|unique:barang,no_part,' . $id,
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'brand' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'supplier_id' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = $barang->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambar) {
                $oldPath = public_path('uploads/barang/' . $gambar);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('gambar');
            $gambar = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $gambar);
        }

        $barang->update([
            'no_part' => $validated['no_part'],
            'nama_barang' => $validated['nama_barang'],
            'kategori_id' => $validated['kategori_id'],
            'brand' => $validated['brand'],
            'stok' => $validated['stok'],
            'harga' => $validated['harga'],
            'gambar' => $gambar,
            'supplier_id' => $validated['supplier_id'],
        ]);

        return redirect()
            ->route('admin.data-barang.index')
            ->with('success', 'Data barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar) {
            $path = public_path('uploads/barang/' . $barang->gambar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $barang->delete();

        return redirect()
            ->route('admin.data-barang.index')
            ->with('success', 'Data barang berhasil dihapus');
    }
}