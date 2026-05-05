<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerBarangController extends Controller
{
    public function index(Request $request)
    {
        // DATA DUMMY
        $barang = collect([
            (object)[
                'no_part' => 'BRG-001',
                'nama_barang' => 'Oli Mesin',
                'brand' => 'Honda',
                'stok' => 10,
                'harga' => 50000,
                'kategori' => (object)[
                    'nama_kategori' => 'Oli'
                ],
                'supplier' => (object)[
                    'nama_supplier' => 'PT Sumber Jaya'
                ],
            ],
            (object)[
                'no_part' => 'BRG-002',
                'nama_barang' => 'Filter Udara',
                'brand' => 'Toyota',
                'stok' => 3,
                'harga' => 75000,
                'kategori' => (object)[
                    'nama_kategori' => 'Filter'
                ],
                'supplier' => (object)[
                    'nama_supplier' => 'PT Maju Jaya'
                ],
            ],
        ]);

        return view('pages.manager.data-barang', compact('barang'));
    }
}