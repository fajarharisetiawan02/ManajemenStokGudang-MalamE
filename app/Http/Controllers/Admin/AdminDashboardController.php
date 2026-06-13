<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // ============ STATISTIK ============
        $totalBarang  = Barang::count();
        $barangMasuk  = BarangMasuk::whereDate('tanggal', $today)->sum('jumlah');
        $barangKeluar = BarangKeluar::whereDate('tanggal', $today)->sum('jumlah');
        $supplier     = Supplier::count();

        // ============ CHART PERGERAKAN STOK (12 bulan terakhir) ============
        $labels    = [];
        $masukArr  = [];
        $keluarArr = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::today()->subMonths($i);
            $labels[]    = $month->translatedFormat('M Y');
            $masukArr[]  = BarangMasuk::whereYear('tanggal', $month->year)
                                ->whereMonth('tanggal', $month->month)
                                ->sum('jumlah');
            $keluarArr[] = BarangKeluar::whereYear('tanggal', $month->year)
                                ->whereMonth('tanggal', $month->month)
                                ->sum('jumlah');
        }

        $chartData = [
            'labels' => $labels,
            'masuk'  => $masukArr,
            'keluar' => $keluarArr,
        ];

        // ============ CHART DONUT DISTRIBUSI SUPPLIER (Top 5 + Lainnya) ============
        $allSupplier = BarangMasuk::with('supplier')
            ->select('supplier_id', DB::raw('SUM(jumlah) as total'))
            ->whereNotNull('supplier_id')
            ->groupBy('supplier_id')
            ->orderByDesc('total')
            ->get()
            ->map(fn($item) => [
                'nama'  => $item->supplier->nama_supplier ?? 'Unknown',
                'total' => (int) $item->total,
            ]);

        $top5    = $allSupplier->take(5);
        $lainnya = $allSupplier->skip(5);

        if ($lainnya->count() > 0) {
            $distribusiSupplier = $top5->push([
                'nama'  => 'Lainnya',
                'total' => $lainnya->sum('total'),
            ]);
        } else {
            $distribusiSupplier = $top5;
        }

        $totalStok = Barang::sum('stok');

        // ============ TRANSAKSI TERBARU ============
        $masukTerbaru = BarangMasuk::with('barang')
            ->latest('tanggal')
            ->limit(5)
            ->get()
            ->map(fn($item) => (object)[
                'tanggal' => $item->tanggal,
                'barang'  => $item->barang?->nama_barang ?? '-',
                'qty'     => $item->jumlah,
                'status'  => 'Masuk',
            ]);

        $keluarTerbaru = BarangKeluar::with('barang')
            ->latest('tanggal')
            ->limit(5)
            ->get()
            ->map(fn($item) => (object)[
                'tanggal' => $item->tanggal,
                'barang'  => $item->barang?->nama_barang ?? '-',
                'qty'     => $item->jumlah,
                'status'  => 'Keluar',
            ]);

        $transaksi = $masukTerbaru->concat($keluarTerbaru)
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();

        // ============ STOK MENIPIS (stok <= 10) ============
        $stokMenipis = Barang::with('kategori')
            ->where('stok', '<=', 10)
            ->orderBy('stok', 'ASC')
            ->limit(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalBarang',
            'barangMasuk',
            'barangKeluar',
            'supplier',
            'chartData',
            'distribusiSupplier',
            'totalStok',
            'transaksi',
            'stokMenipis'
        ));
    }
}