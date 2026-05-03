<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = session('kategori', []);

        // kalau kosong, isi default
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

        // pastikan tetap object
        $kategori = collect($kategori)
            ->map(fn($item) => (object) $item)
            ->toArray();

        return view('pages.admin.kategori', compact('kategori'));
    }

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

        $kategori = collect($kategori)
            ->map(fn($item) => (object) $item)
            ->toArray();

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required',
            'kelompok' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        $kategori = session('kategori', []);

        $kategori = collect($kategori)
            ->map(fn($item) => (object) $item)
            ->toArray();

        foreach ($kategori as $key => $item) {

            if ($item->id == $id) {

                $kategori[$key]->nama = $request->nama;
                $kategori[$key]->jumlah = $request->jumlah;
                $kategori[$key]->status = $request->status;
                $kategori[$key]->kelompok = $request->kelompok;

                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $name = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('uploads'), $name);

                    $kategori[$key]->foto = 'uploads/'.$name;
                }
            }
        }

        session(['kategori' => $kategori]);

        return back();
    }

    public function destroy($id)
    {
        $kategori = session('kategori', []);

        $kategori = collect($kategori)
            ->map(fn($item) => (object) $item)
            ->toArray();

        $kategori = array_values(array_filter($kategori, function ($item) use ($id) {
            return $item->id != $id;
        }));

        session(['kategori' => $kategori]);

        return back();
    }
}