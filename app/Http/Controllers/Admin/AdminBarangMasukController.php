<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBarangMasukController extends Controller
{
    public function index()
    {
        $data = session('barang_masuk', [
            [
                'tanggal' => '2026-05-13',
                'kode' => 'HD-001',
                'nama' => 'Oli Mesin 10W40',
                'jumlah' => 25,
                'supplier' => 'PT Astra',
            ],
            [
                'tanggal' => '2026-05-13',
                'kode' => 'TY-002',
                'nama' => 'Filter Udara Avanza',
                'jumlah' => 8,
                'supplier' => 'PT Indoparts',
            ],
            [
                'tanggal' => '2026-05-13',
                'kode' => 'SZ-003',
                'nama' => 'Kampas Rem Depan',
                'jumlah' => 3,
                'supplier' => 'PT Astra',
            ],
        ]);

        return view('pages.admin.barang-masuk', compact('data'));
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

                return redirect()->route('admin.barang-masuk.index')
                    ->with('success', 'Data berhasil diupdate');
            }

            return redirect()->route('admin.barang-masuk.index')
                ->with('error', 'Data tidak ditemukan');
        }

        // ================= TAMBAH =================
        $data[] = $item;
        session(['barang_masuk' => $data]);

        return redirect()->route('admin.barang-masuk.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
}