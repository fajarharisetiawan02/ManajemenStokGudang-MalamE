<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = session('kategori', []);

        if (count($kategori) == 0) {
            $kategori = [
                (object)[
                    'id' => 1,
                    'nama' => 'Oli Mesin',
                    'jumlah' => 20,
                    'status' => 'aktif',
                    'kelompok' => 'engine',
                    'foto' => null
                ],
                (object)[
                    'id' => 2,
                    'nama' => 'Ban Mobil',
                    'jumlah' => 10,
                    'status' => 'aktif',
                    'kelompok' => 'suspension',
                    'foto' => null
                ],
                (object)[
                    'id' => 3,
                    'nama' => 'Aki',
                    'jumlah' => 5,
                    'status' => 'nonaktif',
                    'kelompok' => 'electrical',
                    'foto' => null
                ],
            ];

            session(['kategori' => $kategori]);
        }

        return view('pages.admin.kategori', compact('kategori'));
    }

    /* ================= STORE ================= */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required',
            'kelompok' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        $kategori = session('kategori', []);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads'), $name);

            $fotoPath = 'uploads/'.$name;
        }

        $kategori[] = (object)[
            'id' => time(),
            'nama' => $data['nama'],
            'jumlah' => $data['jumlah'],
            'status' => $data['status'],
            'kelompok' => $data['kelompok'],
            'foto' => $fotoPath
        ];

        session(['kategori' => $kategori]);

        return back();
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        $kategori = session('kategori', []);

        foreach ($kategori as &$item) {

            if ($item->id == $id) {

                $item->nama = $request->nama;
                $item->jumlah = $request->jumlah;
                $item->status = $request->status;
                $item->kelompok = $request->kelompok;

                if ($request->hasFile('foto')) {

                    $file = $request->file('foto');
                    $name = time().'_'.$file->getClientOriginalName();

                    $file->move(public_path('uploads'), $name);

                    $item->foto = 'uploads/'.$name;
                }

                if ($request->has('hapus_foto')) {
                    $item->foto = null;
                }
            }
        }

        session(['kategori' => $kategori]);

        return back();
    }

    /* ================= DELETE (FIX 100% WORKING) ================= */
    public function destroy($id)
    {
        $kategori = session('kategori', []);

        $kategori = array_filter($kategori, function ($item) use ($id) {
            return $item->id != $id;
        });

        // 🔥 FIX UTAMA: WAJIB pakai KEY 'kategori'
        session(['kategori' => array_values($kategori)]);

        return back();
    }
}