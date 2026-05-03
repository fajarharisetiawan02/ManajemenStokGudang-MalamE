<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        if ($request->filled('edit_index')) {

            $index = $request->edit_index;

            if (isset($data[$index])) {
                $data[$index] = $item;
                session(['barang_masuk' => $data]);

                return redirect()->route('barang-masuk.index')
                    ->with('success', 'Data berhasil diupdate');
            }

            return redirect()->route('barang-masuk.index')
                ->with('error', 'Data tidak ditemukan');
        }

        // ================= TAMBAH =================
        $data[] = $item;

        session(['barang_masuk' => $data]);

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
}