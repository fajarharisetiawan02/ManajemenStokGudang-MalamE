<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; // ⭐ TAMBAHKAN INI

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = 1250;
        $barangMasuk = 45;
        $barangKeluar = 20;
        $supplier = 18;

        $transaksi = [
            (object)[
                'tanggal' => '21 Apr',
                'barang' => 'Oli Mesin',
                'qty' => 20,
                'status' => 'Masuk'
            ],
            (object)[
                'tanggal' => '21 Apr',
                'barang' => 'Kampas Rem',
                'qty' => 5,
                'status' => 'Keluar'
            ],
        ];

        $stokMenipis = [
            (object)['nama' => 'Filter Udara', 'stok' => 2],
            (object)['nama' => 'Busi', 'stok' => 4],
        ];

        return view('pages.admin.dashboard', compact(
            'totalBarang',
            'barangMasuk',
            'barangKeluar',
            'supplier',
            'transaksi',
            'stokMenipis'
        ));
    }
}