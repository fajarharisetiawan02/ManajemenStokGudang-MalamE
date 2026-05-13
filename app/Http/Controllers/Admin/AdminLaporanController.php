<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $barangMasuk = session('barang_masuk', []);
        $barangKeluar = session('barang_keluar', []);

        $totalMasuk = array_sum(array_column($barangMasuk, 'jumlah'));
        $totalKeluar = array_sum(array_column($barangKeluar, 'jumlah'));
        $stokAkhir = $totalMasuk - $totalKeluar;

        $laporan = [];

        foreach ($barangMasuk as $index => $item) {
            $laporan[] = (object) [
                'tanggal' => $item['tanggal'] ?? '-',
                'no' => 'BM-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'barang' => $item['nama'] ?? '-',
                'jenis' => 'Masuk',
                'jumlah' => '+' . ($item['jumlah'] ?? 0),
                'keterangan' => 'Pembelian',
            ];
        }

        foreach ($barangKeluar as $index => $item) {
            $laporan[] = (object) [
                'tanggal' => $item['tanggal'] ?? '-',
                'no' => 'BK-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'barang' => $item['nama'] ?? '-',
                'jenis' => 'Keluar',
                'jumlah' => '-' . ($item['jumlah'] ?? 0),
                'keterangan' => 'Penjualan',
            ];
        }

        // isi contoh kalau masih kosong
        if (empty($laporan)) {
            $laporan = [
                (object) [
                    'tanggal' => '26-04-2026',
                    'no' => 'BM-001',
                    'barang' => 'Oli Mesin',
                    'jenis' => 'Masuk',
                    'jumlah' => '+50',
                    'keterangan' => 'Pembelian',
                ],
                (object) [
                    'tanggal' => '26-04-2026',
                    'no' => 'BK-001',
                    'barang' => 'Ban Mobil',
                    'jenis' => 'Keluar',
                    'jumlah' => '-20',
                    'keterangan' => 'Penjualan',
                ],
            ];

            $totalMasuk = 50;
            $totalKeluar = 20;
            $stokAkhir = 30;
        }

        usort($laporan, function ($a, $b) {
            return strtotime($a->tanggal) <=> strtotime($b->tanggal);
        });

        return view('pages.admin.laporan', compact(
            'laporan',
            'totalMasuk',
            'totalKeluar',
            'stokAkhir'
        ));
    }
}