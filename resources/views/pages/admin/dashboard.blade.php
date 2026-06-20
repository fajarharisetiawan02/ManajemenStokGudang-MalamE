@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- PASS DATA KE dashboard.js --}}
    <div id="dashboardData" class="hidden" data-labels='@json($chartData['labels'])' data-masuk='@json($chartData['masuk'])'
        data-keluar='@json($chartData['keluar'])' data-supplier='@json($distribusiSupplier)'>
    </div>

    {{-- HERO --}}
    <div
        class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl border border-blue-500 shadow-sm mb-8 px-8 py-6 flex items-center justify-between relative overflow-hidden">
        <div class="text-white max-w-lg z-20">
            <h1 class="text-3xl font-bold mb-1">Halo! 👋</h1>
            <h2 class="text-xl font-semibold text-white/95">
                {{ Auth::user()->name ?? 'Admin GudangPro' }}
            </h2>
            <p class="mt-3 text-base text-white/90 leading-relaxed max-w-md">
                Pantau stok barang, transaksi masuk & keluar, serta aktivitas gudang secara real-time dengan GudangPro.
            </p>
        </div>
        <img src="{{ asset('images/LogoDashboard.png') }}" alt="Dashboard Illustration"
            class="hidden lg:block absolute right-6 bottom-0 h-[180px] object-contain z-10">
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        {{-- TOTAL BARANG --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-1 bg-blue-600"></div>
            <div class="p-6 flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Total Barang</p>
                    <h3 class="text-4xl font-bold text-slate-800 mt-3">{{ number_format($totalBarang) }}</h3>
                    <span class="inline-flex mt-3 px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-semibold">
                        Semua Barang
                    </span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-box text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- BARANG MASUK --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-1 bg-green-600"></div>
            <div class="p-6 flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Barang Masuk</p>
                    <h3 class="text-4xl font-bold text-green-600 mt-3">{{ number_format($barangMasuk) }}</h3>
                    <span class="inline-flex mt-3 px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-semibold">
                        Hari Ini
                    </span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                    <i class="fas fa-arrow-down text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- BARANG KELUAR --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-1 bg-red-600"></div>
            <div class="p-6 flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Barang Keluar</p>
                    <h3 class="text-4xl font-bold text-red-600 mt-3">{{ number_format($barangKeluar) }}</h3>
                    <span class="inline-flex mt-3 px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs font-semibold">
                        Hari Ini
                    </span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">
                    <i class="fas fa-arrow-up text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- SUPPLIER --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-1 bg-purple-600"></div>
            <div class="p-6 flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Supplier</p>
                    <h3 class="text-4xl font-bold text-purple-600 mt-3">{{ number_format($supplier) }}</h3>
                    <span
                        class="inline-flex mt-3 px-3 py-1 rounded-full bg-purple-100 text-purple-600 text-xs font-semibold">
                        Aktif
                    </span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-truck text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">

        {{-- PERGERAKAN STOK --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[430px] flex flex-col">
            <div class="flex flex-wrap justify-between items-start gap-4 mb-5">
                <div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-chart-area text-blue-600 text-xl"></i>
                        <div>
                            <h3 class="font-bold text-lg text-slate-800">Pergerakan Stok</h3>
                            <p class="text-sm text-slate-500">Barang masuk dan keluar dalam periode tertentu</p>
                        </div>
                    </div>
                    <span class="inline-flex mt-3 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                        12 Bulan Terakhir
                    </span>
                </div>
            </div>
            <div class="flex-1">
                <canvas id="stokChart"></canvas>
            </div>
        </div>

        {{-- DISTRIBUSI SUPPLIER --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[430px] flex flex-col">
            <div class="flex items-center gap-3 mb-5">
                <i class="fas fa-chart-pie text-blue-600 text-xl"></i>
                <div>
                    <h3 class="font-bold text-lg text-slate-800">Distribusi Stok per Supplier</h3>
                    <p class="text-sm text-slate-500">Persentase stok berdasarkan pemasok</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 flex-1">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-[220px]">
                        <canvas id="donutGudang"></canvas>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <div id="legendSupplier" class="space-y-3 text-sm font-medium text-slate-700"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- TRANSAKSI TERBARU --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="font-bold text-xl text-slate-800">
                    <i class="fas fa-clock-rotate-left text-green-600 mr-2"></i>
                    Transaksi Terbaru
                </h3>
                <p class="text-sm text-slate-500 mt-1">Aktivitas barang masuk dan keluar terbaru</p>
            </div>
            <a href="{{ route('admin.barang-masuk.index') }}"
                class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                Lihat Semua →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold border w-12">No</th>
                        <th class="px-4 py-3 text-left font-bold border">Tanggal</th>
                        <th class="px-4 py-3 text-left font-bold border">Nama Barang</th>
                        <th class="px-4 py-3 text-center font-bold border">Jenis</th>
                        <th class="px-4 py-3 text-center font-bold border">Qty</th>
                        <th class="px-4 py-3 text-center font-bold border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $i => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-4 border text-center">{{ $i + 1 }}</td>
                            <td class="px-4 py-4 border">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-4 py-4 border font-medium text-slate-800">{{ $item->barang }}</td>
                            <td class="px-4 py-4 border text-center">
                                @if ($item->status === 'Masuk')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        <i class="fas fa-arrow-down mr-1"></i> Masuk
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        <i class="fas fa-arrow-up mr-1"></i> Keluar
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 border text-center">
                                @if ($item->status === 'Masuk')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        +{{ $item->qty }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        -{{ $item->qty }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 border text-center">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-slate-400">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- STOK MENIPIS --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-triangle-exclamation text-orange-500 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Produk Stok Menipis</h3>
                    <p class="text-sm text-slate-500">Produk yang membutuhkan restock segera</p>
                </div>
            </div>
            <a href="{{ route('admin.data-barang.index') }}?stok=menipis"
                class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white
            px-4 py-2 rounded-xl shadow-sm transition text-sm font-medium">
                <i class="fas fa-eye"></i> Lihat Semua Produk
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold border w-12">No</th>
                        <th class="px-4 py-3 text-left font-bold border">Kode Part</th>
                        <th class="px-4 py-3 text-left font-bold border">Nama Barang</th>
                        <th class="px-4 py-3 text-left font-bold border">Kategori</th>
                        <th class="px-4 py-3 text-center font-bold border">Stok</th>
                        <th class="px-4 py-3 text-center font-bold border">Status</th>
                        <th class="px-4 py-3 text-center font-bold border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokMenipis as $i => $barang)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-4 border text-center">{{ $i + 1 }}</td>
                            <td class="px-4 py-4 border">{{ $barang->kode }}</td>
                            <td class="px-4 py-4 border font-medium text-slate-800">{{ $barang->nama_barang }}</td>
                            <td class="px-4 py-4 border">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                    {{ $barang->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 border text-center">
                                @if ($barang->stok <= 0)
                                    <span
                                        class="inline-flex items-center justify-center min-w-[50px] px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                        {{ $barang->stok }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center justify-center min-w-[50px] px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                        {{ $barang->stok }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 border text-center">
                                @if ($barang->stok <= 0)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        <i class="fas fa-times-circle mr-1"></i> Habis
                                    </span>
                                @elseif($barang->stok <= 5)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        <i class="fas fa-triangle-exclamation mr-1"></i> Kritis
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                        <i class="fas fa-exclamation mr-1"></i> Menipis
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 border text-center">
                                <a href="{{ route('admin.data-barang.show', $barang->id) }}"
                                    class="px-3 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg shadow-sm transition text-xs">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-green-600 font-semibold">
                                <i class="fas fa-check-circle mr-2"></i> Semua stok dalam kondisi aman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
