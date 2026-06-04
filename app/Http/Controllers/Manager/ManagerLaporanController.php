<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ManagerLaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan = [];

        // BARANG MASUK
        foreach (BarangMasuk::with(['barang', 'supplier'])->get() as $item) {

            $laporan[] = (object) [
                'tanggal'    => $item->tanggal,
                'no'         => 'BM-' . str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'kode'       => $item->barang?->kode ?? '-',
                'barang'     => $item->barang?->nama_barang ?? '-',
                'jenis'      => 'Masuk',
                'jumlah'     => '+' . $item->jumlah,
                'supplier'   => $item->supplier?->nama_supplier ?? '-',
                'keterangan' => 'Barang Masuk',
            ];
        }

        // BARANG KELUAR
        foreach (BarangKeluar::with('barang')->get() as $item) {

            $laporan[] = (object) [
                'tanggal'    => $item->tanggal,
                'no'         => 'BK-' . str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'kode'       => $item->barang?->kode ?? '-',
                'barang'     => $item->barang?->nama_barang ?? '-',
                'jenis'      => 'Keluar',
                'jumlah'     => '-' . $item->jumlah,
                'supplier'   => '-',
                'keterangan' => 'Barang Keluar',
            ];
        }

        // FILTER JENIS TRANSAKSI
        if ($request->filled('jenis')) {

            $laporan = array_filter($laporan, function ($item) use ($request) {

                return $item->jenis === $request->jenis;

            });

        }

        // URUTKAN BERDASARKAN TANGGAL TERBARU
        usort($laporan, function ($a, $b) {

            return strtotime($b->tanggal) <=> strtotime($a->tanggal);

        });

        // SUMMARY
        $totalMasuk = BarangMasuk::sum('jumlah');
        $totalKeluar = BarangKeluar::sum('jumlah');
        $stokAkhir = $totalMasuk - $totalKeluar;

        // PAGINATION
        $perPage = 10;
        $currentPage = request()->get('page', 1);

        $items = collect($laporan);

        $laporan = new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view(
            'pages.manager.laporan',
            compact(
                'laporan',
                'totalMasuk',
                'totalKeluar',
                'stokAkhir'
            )
        );
    }
}