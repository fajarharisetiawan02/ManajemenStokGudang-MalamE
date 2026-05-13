<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        //DATA STATISTIK
        $totalBarang = 1250;
        $barangMasuk = 45;
        $barangKeluar = 20;
        $supplier = 18;

        //DATA TRANSAKSI TERBARU
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

        //DATA STOK MENIPIS
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

        //VIEW MANAGER (PENTING)
        return view('pages.manager.dashboard', compact(
            'totalBarang',
            'barangMasuk',
            'barangKeluar',
            'supplier',
            'transaksi',
            'stokMenipis'
        ));
    }
}