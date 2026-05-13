<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerLaporanController extends Controller
{
    public function index()
    {
        // Ambil data dari session, kalau kosong pakai data contoh
        $barangMasuk = session('barang_masuk', [
            [
                'tanggal' => '26-04-2026',
                'kode' => 'BM-001',
                'nama' => 'Oli Mesin',
                'jumlah' => 50,
                'supplier' => 'PT Astra',
                'keterangan' => 'Pembelian',
            ],
        ]);

        $barangKeluar = session('barang_keluar', [
            [
                'tanggal' => '26-04-2026',
                'kode' => 'BK-001',
                'nama' => 'Ban Mobil',
                'jumlah' => 20,
                'supplier' => 'PT Indoparts',
                'keterangan' => 'Penjualan',
            ],
        ]);

        $laporanMasuk = collect($barangMasuk)->map(function ($item, $index) {
            $jumlah = (int) ($item['jumlah'] ?? 0);

            return (object) [
                'tanggal' => $item['tanggal'] ?? now()->format('d-m-Y'),
                'no' => $item['kode'] ?? 'BM-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'barang' => $item['nama'] ?? '-',
                'jenis' => 'Masuk',
                'jumlah' => '+' . $jumlah,
                'keterangan' => $item['keterangan'] ?? 'Pembelian',
                'sort_tanggal' => strtotime($item['tanggal'] ?? now()->format('Y-m-d')),
            ];
        });

        $laporanKeluar = collect($barangKeluar)->map(function ($item, $index) {
            $jumlah = (int) ($item['jumlah'] ?? 0);

            return (object) [
                'tanggal' => $item['tanggal'] ?? now()->format('d-m-Y'),
                'no' => $item['kode'] ?? 'BK-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'barang' => $item['nama'] ?? '-',
                'jenis' => 'Keluar',
                'jumlah' => '-' . $jumlah,
                'keterangan' => $item['keterangan'] ?? 'Penjualan',
                'sort_tanggal' => strtotime($item['tanggal'] ?? now()->format('Y-m-d')),
            ];
        });

        $laporan = $laporanMasuk
            ->concat($laporanKeluar)
            ->sortByDesc('sort_tanggal')
            ->values()
            ->map(function ($item) {
                unset($item->sort_tanggal);
                return $item;
            });

        $totalMasuk = collect($barangMasuk)->sum(function ($item) {
            return (int) ($item['jumlah'] ?? 0);
        });

        $totalKeluar = collect($barangKeluar)->sum(function ($item) {
            return (int) ($item['jumlah'] ?? 0);
        });

        $stokAkhir = $totalMasuk - $totalKeluar;

        return view('pages.manager.laporan', compact(
            'laporan',
            'totalMasuk',
            'totalKeluar',
            'stokAkhir'
        ));
    }
}