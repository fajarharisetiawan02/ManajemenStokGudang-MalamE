<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;

class AdminBarangController extends Controller
{
    // =========================
    // TAMPIL DATA
    // =========================
    public function index()
    {
        $barang = session('barang', []);

        // DATA DUMMY
        $kategori = [
            (object)['id' => 1, 'nama_kategori' => 'Oli'],
            (object)['id' => 2, 'nama_kategori' => 'Ban'],
            (object)['id' => 3, 'nama_kategori' => 'Aki'],
        ];

        $supplier = [
            (object)['id' => 1, 'nama_supplier' => 'PT Astra'],
            (object)['id' => 2, 'nama_supplier' => 'PT Indoparts'],
        ];

        $brand = ['Toyota', 'Honda', 'Daihatsu'];

        return view('pages.admin.data-barang', compact('barang', 'kategori', 'supplier', 'brand'));
    }

    // =========================
    // TAMBAH DATA (INI YANG KURANG)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'no_part' => 'required',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'brand' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'supplier_id' => 'required',
        ]);

        $barang = session('barang', []);

        // cari kategori & supplier dari dummy
        $kategoriList = [
            1 => 'Oli',
            2 => 'Ban',
            3 => 'Aki',
        ];

        $supplierList = [
            1 => 'PT Astra',
            2 => 'PT Indoparts',
        ];

        $barang[] = (object)[
            'id' => count($barang) + 1,
            'no_part' => $request->no_part,
            'nama_barang' => $request->nama_barang,
            'brand' => $request->brand,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => (object)[
                'nama_kategori' => $kategoriList[$request->kategori_id] ?? '-'
            ],
            'supplier' => (object)[
                'nama_supplier' => $supplierList[$request->supplier_id] ?? '-'
            ],
        ];

        session(['barang' => $barang]);

        return redirect('admin/data-barang')->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $barang = session('barang', []);

        foreach ($barang as $key => $item) {
            if ($item->id == $id) {
                $barang[$key]->no_part = $request->no_part;
                $barang[$key]->nama_barang = $request->nama_barang;
                $barang[$key]->brand = $request->brand;
                $barang[$key]->stok = $request->stok;
                $barang[$key]->harga = $request->harga;
                $barang[$key]->kategori = (object)['nama_kategori' => $request->kategori];
                $barang[$key]->supplier = (object)['nama_supplier' => $request->supplier];
            }
        }

        session(['barang' => $barang]);

        return redirect('admin/data-barang')->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $barang = session('barang', []);

        $barang = array_values(array_filter($barang, fn($item) => $item->id != $id));

        session(['barang' => $barang]);

        return redirect('admin/data-barang')->with('success', 'Data berhasil dihapus');
    }
}