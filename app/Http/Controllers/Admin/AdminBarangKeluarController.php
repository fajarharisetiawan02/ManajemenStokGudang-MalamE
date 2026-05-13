<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBarangKeluarController extends Controller
{
    public function index()
    {
        $data = session('barang_keluar', [
            [
                'tanggal' => '2026-05-13',
                'kode' => 'BK-001',
                'nama' => 'Oli Mesin 10W40',
                'jumlah' => 5,
                'tujuan' => 'Bengkel A',
            ],
            [
                'tanggal' => '2026-05-13',
                'kode' => 'BK-002',
                'nama' => 'Filter Udara Avanza',
                'jumlah' => 2,
                'tujuan' => 'Service Internal',
            ],
            [
                'tanggal' => '2026-05-13',
                'kode' => 'BK-003',
                'nama' => 'Kampas Rem Depan',
                'jumlah' => 1,
                'tujuan' => 'Customer',
            ],
        ]);

        return view('pages.admin.barang-keluar', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kode' => 'required',
            'nama' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tujuan' => 'required'
        ]);

        $data = session('barang_keluar', []);

        $item = [
            'tanggal' => $request->tanggal,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'tujuan' => $request->tujuan,
        ];

        if ($request->filled('edit_index')) {
            $index = $request->edit_index;

            if (isset($data[$index])) {
                $data[$index] = $item;
                session(['barang_keluar' => $data]);

                return redirect()->route('admin.barang-keluar.index')
                    ->with('success', 'Data berhasil diupdate');
            }

            return redirect()->route('admin.barang-keluar.index')
                ->with('error', 'Data tidak ditemukan');
        }

        $data[] = $item;
        session(['barang_keluar' => $data]);

        return redirect()->route('admin.barang-keluar.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
}