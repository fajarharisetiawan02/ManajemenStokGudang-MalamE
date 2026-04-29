<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = session('barang', []);

        return view('pages.admin.data-barang', compact('barang'));
    }

    public function store(Request $request)
    {
        $barang = session('barang', []);

        $barang[] = (object)[
            'id' => count($barang) + 1,
            'no_part' => $request->no_part,
            'nama_barang' => $request->nama_barang,
            'kategori' => (object)['nama_kategori' => $request->kategori],
            'brand' => $request->brand,
            'supplier' => (object)['nama_supplier' => $request->supplier],
            'stok' => $request->stok,
            'harga' => $request->harga
        ];

        session(['barang' => $barang]);

        return redirect('/data-barang')->with('success', 'tambah');
    }

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

        return redirect('/data-barang')->with('success', 'update');
    }

    public function destroy($id)
    {
        $barang = session('barang', []);

        $barang = array_values(array_filter($barang, fn($item) => $item->id != $id));

        session(['barang' => $barang]);

        return redirect('/data-barang')->with('success', 'delete');
    }
}