<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerBarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = [
            [
                'id' => 1,
                'tanggal' => '2026-05-10',
                'kode' => 'BRG-001',
                'nama' => 'Oli Mesin',
                'jumlah' => 5,
                'tujuan' => 'Workshop A',
            ],
            [
                'id' => 2,
                'tanggal' => '2026-05-11',
                'kode' => 'BRG-002',
                'nama' => 'Filter Udara',
                'jumlah' => 3,
                'tujuan' => 'Cabang Batam',
            ],
            [
                'id' => 3,
                'tanggal' => '2026-05-12',
                'kode' => 'BRG-003',
                'nama' => 'Kampas Rem',
                'jumlah' => 2,
                'tujuan' => 'Gudang Utama',
            ],
        ];

        return view('pages.manager.barang-keluar', compact('barangKeluar'));
    }
}