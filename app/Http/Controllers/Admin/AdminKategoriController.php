<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\File;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::whereNull('parent_id')
            ->with('children.barang')
            ->orderBy('nama_kategori', 'ASC')
            ->get();

        return view('pages.admin.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100',
            'parent_id' => 'nullable|exists:kategori,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/kategori'), $namaFile);
            $foto = 'uploads/kategori/'.$namaFile;
        }

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'parent_id' => $request->parent_id,
            'foto' => $foto
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|max:100',
            'parent_id' => 'nullable|exists:kategori,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'parent_id' => $request->parent_id
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/kategori'), $namaFile);
            $data['foto'] = 'uploads/kategori/'.$namaFile;
        }

        $kategori->update($data);

        return back()->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}