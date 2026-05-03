<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔹 DATA STATISTIK
        $totalBarang = 1250;
        $barangMasuk = 45;
        $barangKeluar = 20;
        $supplier = 18;

        // 🔹 DATA TRANSAKSI TERBARU
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
            (object)[
                'tanggal' => '20 Apr',
                'barang' => 'Aki Mobil',
                'qty' => 8,
                'status' => 'Masuk'
            ],
        ];

        // 🔹 DATA STOK MENIPIS
        $stokMenipis = [
            (object)[
                'nama' => 'Filter Udara',
                'stok' => 2
            ],
            (object)[
                'nama' => 'Busi',
                'stok' => 4
            ],
            (object)[
                'nama' => 'Lampu Depan',
                'stok' => 1
            ],
        ];

        // 🔹 KIRIM KE VIEW
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