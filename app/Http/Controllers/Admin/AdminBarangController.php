<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBarangController extends Controller
{
    private function kategoriData(): array
    {
        return [
            (object) ['id' => 1, 'nama_kategori' => 'Oli'],
            (object) ['id' => 2, 'nama_kategori' => 'Ban'],
            (object) ['id' => 3, 'nama_kategori' => 'Aki'],
        ];
    }

    private function supplierData(): array
    {
        return [
            (object) ['id' => 1, 'nama_supplier' => 'PT Astra'],
            (object) ['id' => 2, 'nama_supplier' => 'PT Indoparts'],
        ];
    }

    private function brandData(): array
    {
        return ['Toyota', 'Honda', 'Daihatsu', 'Suzuki'];
    }

    private function getKategoriName($kategoriId): string
    {
        foreach ($this->kategoriData() as $kategori) {
            if ((string) $kategori->id === (string) $kategoriId) {
                return $kategori->nama_kategori;
            }
        }

        return '-';
    }

    private function getSupplierName($supplierId): string
    {
        foreach ($this->supplierData() as $supplier) {
            if ((string) $supplier->id === (string) $supplierId) {
                return $supplier->nama_supplier;
            }
        }

        return '-';
    }

    private function seedBarangIfEmpty(): void
    {
        if (session()->has('barang') && !empty(session('barang'))) {
            return;
        }

        session([
            'barang' => [
                (object) [
                    'id' => 1,
                    'no_part' => 'HD-001',
                    'nama_barang' => 'Oli Mesin 10W40',
                    'kategori_id' => 1,
                    'brand' => 'Honda',
                    'stok' => 25,
                    'harga' => 85000,
                    'supplier_id' => 1,
                    'kategori' => (object) ['nama_kategori' => 'Oli'],
                    'supplier' => (object) ['nama_supplier' => 'PT Astra'],
                ],
                (object) [
                    'id' => 2,
                    'no_part' => 'TY-002',
                    'nama_barang' => 'Filter Udara Avanza',
                    'kategori_id' => 2,
                    'brand' => 'Toyota',
                    'stok' => 8,
                    'harga' => 120000,
                    'supplier_id' => 2,
                    'kategori' => (object) ['nama_kategori' => 'Ban'],
                    'supplier' => (object) ['nama_supplier' => 'PT Indoparts'],
                ],
                (object) [
                    'id' => 3,
                    'no_part' => 'SZ-003',
                    'nama_barang' => 'Kampas Rem Depan',
                    'kategori_id' => 3,
                    'brand' => 'Suzuki',
                    'stok' => 3,
                    'harga' => 175000,
                    'supplier_id' => 1,
                    'kategori' => (object) ['nama_kategori' => 'Aki'],
                    'supplier' => (object) ['nama_supplier' => 'PT Astra'],
                ],
            ]
        ]);
    }

    public function index()
    {
        $this->seedBarangIfEmpty();

        $barang = session('barang', []);
        $kategori = $this->kategoriData();
        $supplier = $this->supplierData();
        $brandOptions = $this->brandData();

        return view('pages.admin.data-barang', compact('barang', 'kategori', 'supplier', 'brandOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_part' => 'required|string|max:100',
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required',
            'brand' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'supplier_id' => 'required',
        ]);

        $barang = session('barang', []);

        foreach ($barang as $item) {
            if ((string) $item->no_part === (string) $validated['no_part']) {
                return back()->with('error', 'No Part sudah ada, data tidak boleh dobel.');
            }
        }

        $newId = empty($barang) ? 1 : (collect($barang)->max('id') + 1);

        $barang[] = (object) [
            'id' => $newId,
            'no_part' => $validated['no_part'],
            'nama_barang' => $validated['nama_barang'],
            'kategori_id' => $validated['kategori_id'],
            'brand' => $validated['brand'],
            'stok' => $validated['stok'],
            'harga' => $validated['harga'],
            'supplier_id' => $validated['supplier_id'],
            'kategori' => (object) [
                'nama_kategori' => $this->getKategoriName($validated['kategori_id']),
            ],
            'supplier' => (object) [
                'nama_supplier' => $this->getSupplierName($validated['supplier_id']),
            ],
        ];

        session(['barang' => $barang]);

        return redirect()->route('admin.data-barang.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_part' => 'required|string|max:100',
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required',
            'brand' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'supplier_id' => 'required',
        ]);

        $barang = session('barang', []);

        foreach ($barang as $key => $item) {
            if ((string) $item->id === (string) $id) {
                $barang[$key]->no_part = $validated['no_part'];
                $barang[$key]->nama_barang = $validated['nama_barang'];
                $barang[$key]->kategori_id = $validated['kategori_id'];
                $barang[$key]->brand = $validated['brand'];
                $barang[$key]->stok = $validated['stok'];
                $barang[$key]->harga = $validated['harga'];
                $barang[$key]->supplier_id = $validated['supplier_id'];

                $barang[$key]->kategori = (object) [
                    'nama_kategori' => $this->getKategoriName($validated['kategori_id']),
                ];

                $barang[$key]->supplier = (object) [
                    'nama_supplier' => $this->getSupplierName($validated['supplier_id']),
                ];

                break;
            }
        }

        session(['barang' => $barang]);

        return redirect()->route('admin.data-barang.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = session('barang', []);

        $barang = array_values(array_filter($barang, function ($item) use ($id) {
            return (string) $item->id !== (string) $id;
        }));

        session(['barang' => $barang]);

        return redirect()->route('admin.data-barang.index')
            ->with('success', 'Data berhasil dihapus');
    }
}