<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('pages.admin.barang-masuk', [
            'data' => session('barang_masuk', [])
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kode' => 'required',
            'nama' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'supplier' => 'required'
        ]);

        $data = session('barang_masuk', []);

        $item = [
            'tanggal' => $request->tanggal,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'supplier' => $request->supplier,
        ];

        // ================= EDIT =================
        if ($request->edit_index !== null && $request->edit_index !== '') {

            $data[$request->edit_index] = $item;

            session(['barang_masuk' => $data]);

            return redirect()->route('barang-masuk.index')
                ->with('success', 'Data berhasil diupdate');

        }

        // ================= TAMBAH =================
        $data[] = $item;

        session(['barang_masuk' => $data]);

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
}