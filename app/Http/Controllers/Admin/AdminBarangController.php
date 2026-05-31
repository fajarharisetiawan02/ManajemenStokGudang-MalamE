<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class AdminBarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->get();

        return view('pages.admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('pages.admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:barangs',
            'nama' => 'required',
            'harga_jual' => 'required|numeric',
        ]);

        Barang::create($request->all());

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
    }
}