<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerBarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = [
            [
                'id' => 1,
                'tanggal' => '2026-05-10',
                'kode' => 'BRG-001',
                'nama' => 'Oli Mesin',
                'jumlah' => 20,
                'supplier' => 'PT Astra',
            ],
            [
                'id' => 2,
                'tanggal' => '2026-05-11',
                'kode' => 'BRG-002',
                'nama' => 'Filter Udara',
                'jumlah' => 15,
                'supplier' => 'PT Indoparts',
            ],
            [
                'id' => 3,
                'tanggal' => '2026-05-12',
                'kode' => 'BRG-003',
                'nama' => 'Kampas Rem',
                'jumlah' => 8,
                'supplier' => 'CV Sumber Jaya',
            ],
        ];

        return view('pages.manager.barang-masuk', compact('barangMasuk'));
    }
}