<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Exports\LaporanExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ManagerLaporanController extends Controller
{
    private function getData($dari, $sampai, $jenis)
    {
        $masuk = collect();
        if ($jenis === 'semua' || $jenis === 'masuk') {
            $query = BarangMasuk::with(['barang', 'supplier']);
            if ($dari && $sampai) {
                $query->whereBetween('tanggal', [$dari, $sampai]);
            }
            $masuk = $query->get()->map(fn($item) => (object)[
                'tanggal'    => $item->tanggal,
                'no'         => 'GPM-' . Carbon::parse($item->tanggal)->format('ymd') . '-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                'kode'       => $item->barang?->kode ?? '-',
                'barang'     => $item->barang?->nama_barang ?? '-',
                'jenis'      => 'Masuk',
                'jumlah'     => $item->jumlah,
                'keterangan' => 'Pembelian',
            ]);
        }

        $keluar = collect();
        if ($jenis === 'semua' || $jenis === 'keluar') {
            $query = BarangKeluar::with(['barang']);
            if ($dari && $sampai) {
                $query->whereBetween('tanggal', [$dari, $sampai]);
            }
            $keluar = $query->get()->map(fn($item) => (object)[
                'tanggal'    => $item->tanggal,
                'no'         => 'GPK-' . Carbon::parse($item->tanggal)->format('ymd') . '-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                'kode'       => $item->barang?->kode ?? '-',
                'barang'     => $item->barang?->nama_barang ?? '-',
                'jenis'      => 'Keluar',
                'jumlah'     => $item->jumlah,
                'keterangan' => 'Penjualan',
            ]);
        }

        return $masuk->concat($keluar)->sortByDesc('tanggal')->values();
    }

    public function index(Request $request)
    {
        $dari   = $request->dari   ?? null;
        $sampai = $request->sampai ?? null;
        $jenis  = $request->jenis  ?? 'semua';

        $semua = $this->getData($dari, $sampai, $jenis);

        $totalMasuk  = ($dari && $sampai) ? BarangMasuk::whereBetween('tanggal', [$dari, $sampai])->sum('jumlah') : BarangMasuk::sum('jumlah');
        $totalKeluar = ($dari && $sampai) ? BarangKeluar::whereBetween('tanggal', [$dari, $sampai])->sum('jumlah') : BarangKeluar::sum('jumlah');
        $stokAkhir   = Barang::sum('stok');

        $perPage     = 10;
        $currentPage = request()->get('page', 1);

        $laporan = new \Illuminate\Pagination\LengthAwarePaginator(
            $semua->forPage($currentPage, $perPage),
            $semua->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('pages.manager.laporan', compact(
            'laporan', 'totalMasuk', 'totalKeluar', 'stokAkhir', 'dari', 'sampai', 'jenis'
        ));
    }

    public function exportExcel(Request $request)
    {
        $dari   = $request->dari   ?? null;
        $sampai = $request->sampai ?? null;
        $jenis  = $request->jenis  ?? 'semua';

        $dari_label   = $dari   ?? 'semua';
        $sampai_label = $sampai ?? 'semua';
        $filename = 'laporan-transaksi-' . $dari_label . '-sd-' . $sampai_label . '.xlsx';

        return Excel::download(new LaporanExport($dari, $sampai, $jenis), $filename);
    }

    public function exportPdf(Request $request)
    {
        $dari   = $request->dari   ?? null;
        $sampai = $request->sampai ?? null;
        $jenis  = $request->jenis  ?? 'semua';

        $semua = ($dari && $sampai) ? $this->getData($dari, $sampai, $jenis) : collect();

        $totalMasuk  = ($dari && $sampai) ? BarangMasuk::whereBetween('tanggal', [$dari, $sampai])->sum('jumlah') : 0;
        $totalKeluar = ($dari && $sampai) ? BarangKeluar::whereBetween('tanggal', [$dari, $sampai])->sum('jumlah') : 0;
        $stokAkhir   = Barang::sum('stok');

        $periodeLabel = ($dari && $sampai)
            ? Carbon::parse($dari)->format('d/m/Y') . ' — ' . Carbon::parse($sampai)->format('d/m/Y')
            : 'Semua Periode';

        $pdf = Pdf::loadView('pages.admin.laporan-pdf', [
            'laporan'      => $semua,
            'totalMasuk'   => $totalMasuk,
            'totalKeluar'  => $totalKeluar,
            'stokAkhir'    => $stokAkhir,
            'dari'         => $dari,
            'sampai'       => $sampai,
            'periodeLabel' => $periodeLabel,
            'jenis'        => $jenis,
        ])->setPaper('a4', 'landscape');

        $dari_label   = $dari   ?? 'semua';
        $sampai_label = $sampai ?? 'semua';
        $filename = 'laporan-transaksi-' . $dari_label . '-sd-' . $sampai_label . '.pdf';

        return $pdf->download($filename);
    }
}