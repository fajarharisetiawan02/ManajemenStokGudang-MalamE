<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $barangMasuk = session('barang_masuk', []);
        $barangKeluar = session('barang_keluar', []);

        // TOTAL
        $totalMasuk = array_sum(array_column($barangMasuk, 'jumlah'));
        $totalKeluar = array_sum(array_column($barangKeluar, 'jumlah'));
        $stokAkhir = $totalMasuk - $totalKeluar;

        // LAPORAN
        $laporan = [];

        foreach ($barangMasuk as $item) {
            $laporan[] = (object)[
                'tanggal' => $item['tanggal'] ?? '-',
                'no' => 'BM-' . rand(100, 999),
                'barang' => $item['nama'] ?? '-',
                'jenis' => 'Masuk',
                'jumlah' => '+' . ($item['jumlah'] ?? 0),
                'keterangan' => 'Pembelian'
            ];
        }

        foreach ($barangKeluar as $item) {
            $laporan[] = (object)[
                'tanggal' => $item['tanggal'] ?? '-',
                'no' => 'BK-' . rand(100, 999),
                'barang' => $item['nama'] ?? '-',
                'jenis' => 'Keluar',
                'jumlah' => '-' . ($item['jumlah'] ?? 0),
                'keterangan' => 'Penjualan'
            ];
        }

        return view('pages.admin.laporan', compact(
            'laporan',
            'totalMasuk',
            'totalKeluar',
            'stokAkhir'
        ));
    }
}