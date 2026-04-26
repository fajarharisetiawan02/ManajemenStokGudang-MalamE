<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    // 🔹 TAMPIL DATA BARANG (DUMMY)
    public function index()
    {
        $barang = [
            (object)[
                'id' => 1,
                'no_part' => '04465-0D070',
                'nama_barang' => 'Oli Mesin',
                'kategori' => (object)['nama_kategori' => 'Oli'],
                'supplier' => (object)['nama_supplier' => 'PT Astra'],
                'stok' => 50,
                'harga' => 150000
            ],
            (object)[
                'id' => 2,
                'no_part' => '12345-ABC',
                'nama_barang' => 'Ban Mobil',
                'kategori' => (object)['nama_kategori' => 'Ban'],
                'supplier' => (object)['nama_supplier' => 'PT Bridgestone'],
                'stok' => 20,
                'harga' => 500000
            ]
        ];

        return view('pages.admin.data-barang', compact('barang'));
    }

    // 🔹 FORM TAMBAH
    public function create()
    {
        return view('tambah-barang'); 
    }

    // 🔹 SIMPAN (dummy)
    public function store(Request $request)
    {
        return redirect('/data-barang')
            ->with('success', 'Data berhasil ditambahkan (dummy)');
    }

    // 🔹 EDIT (dummy)
    public function edit($id)
    {
        return view('edit-barang'); 
    }

    // 🔹 UPDATE (dummy)
    public function update(Request $request, $id)
    {
        return redirect('/data-barang')
            ->with('success', 'Data berhasil diupdate (dummy)');
    }

    // 🔹 HAPUS (dummy)
    public function destroy($id)
    {
        return redirect('/data-barang')
            ->with('success', 'Data berhasil dihapus (dummy)');
    }
}