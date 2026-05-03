<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; // ⭐ TAMBAHKAN INI
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        return view('pages.admin.barang-keluar', [
            'data' => session('barang_keluar', [])
        ]);
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

        // EDIT
        if ($request->edit_index !== null && $request->edit_index !== '') {

            $data[$request->edit_index] = $item;

            session(['barang_keluar' => $data]);

            return redirect()->route('barang-keluar.index')
                ->with('success', 'Data berhasil diupdate');
        }

        // TAMBAH
        $data[] = $item;

        session(['barang_keluar' => $data]);

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
}