@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

<div class="w-full space-y-6">

    {{-- FILTER --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="p-5 border-b border-slate-200">
            <p class="text-sm text-slate-500">
                Riwayat transaksi barang masuk dan barang keluar.
            </p>
        </div>

        <div class="p-5">
            <div class="flex flex-wrap gap-3">

                <input type="date"
                    class="px-4 py-2.5 border border-slate-300 rounded-lg text-sm">

                <input type="date"
                    class="px-4 py-2.5 border border-slate-300 rounded-lg text-sm">

                <select
                    class="px-4 py-2.5 border border-slate-300 rounded-lg text-sm">
                    <option>Semua Transaksi</option>
                    <option>Barang Masuk</option>
                    <option>Barang Keluar</option>
                </select>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>

                <button
                    class="border border-slate-300 hover:bg-slate-50 px-5 py-2.5 rounded-lg text-sm">
                    Reset
                </button>

                <div class="ml-auto flex gap-2">
                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-file-excel mr-2"></i>
                        Excel
                    </button>

                    <button
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-file-pdf mr-2"></i>
                        PDF
                    </button>
                </div>

            </div>
        </div>

    </div>

    {{-- CARD SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500">Total Barang Masuk</p>
                    <h3 class="text-4xl font-bold text-green-600 mt-3">
                        {{ $totalMasuk }}
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        Barang masuk tercatat
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="fas fa-arrow-down text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500">Total Barang Keluar</p>
                    <h3 class="text-4xl font-bold text-red-600 mt-3">
                        {{ $totalKeluar }}
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        Barang keluar tercatat
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                    <i class="fas fa-arrow-up text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500">Stok Akhir</p>
                    <h3 class="text-4xl font-bold text-blue-600 mt-3">
                        {{ $stokAkhir }}
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        Total stok tersedia
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-box text-blue-600"></i>
                </div>
            </div>
        </div>

    </div>
<!-- TABLE -->
<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm border-collapse">

            <thead class="bg-slate-50 text-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold border">No</th>
                    <th class="px-4 py-3 text-left font-semibold border">Tanggal</th>
                    <th class="px-4 py-3 text-left font-semibold border">No Transaksi</th>
                    <th class="px-4 py-3 text-left font-semibold border">Kode Part</th>
                    <th class="px-4 py-3 text-left font-semibold border">Nama Barang</th>
                    <th class="px-4 py-3 text-left font-semibold border">Jenis</th>
                    <th class="px-4 py-3 text-left font-semibold border">Qty</th>
                    <th class="px-4 py-3 text-left font-semibold border">Supplier</th>
                    <th class="px-4 py-3 text-left font-semibold border">Keterangan</th>
                </tr>
            </thead>

            <tbody class="bg-white">

                @forelse($laporan as $item)

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-4 border">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-4 border">
                        {{ $item->tanggal }}
                    </td>

                    <td class="px-4 py-4 border font-medium">
                        {{ $item->no }}
                    </td>

                    <td class="px-4 py-4 border">
                        {{ $item->kode ?? '-' }}
                    </td>

                    <td class="px-4 py-4 border font-medium">
                        {{ $item->barang }}
                    </td>

                    <td class="px-4 py-4 border">

                        @if($item->jenis == 'Masuk')
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                Masuk
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                Keluar
                            </span>
                        @endif

                    </td>

                    <td class="px-4 py-4 border">

                        @if($item->jenis == 'Masuk')
                            <span class="font-semibold text-green-600">
                                {{ $item->jumlah }}
                            </span>
                        @else
                            <span class="font-semibold text-red-600">
                                {{ $item->jumlah }}
                            </span>
                        @endif

                    </td>

                    <td class="px-4 py-4 border">
                        {{ $item->supplier ?? '-' }}
                    </td>

                    <td class="px-4 py-4 border">
                        {{ $item->keterangan }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="9" class="py-10 text-center text-gray-500 border">
                        Belum ada data laporan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- FOOTER -->
<div class="flex justify-between items-center px-4 py-3 border-t bg-white">

    <div class="text-sm text-gray-600">
        Showing
        {{ $laporan->firstItem() ?? 0 }}
        to
        {{ $laporan->lastItem() ?? 0 }}
        of
        {{ $laporan->total() }}
        entries
    </div>

    <div class="flex items-center gap-2">

        <a href="{{ $laporan->previousPageUrl() }}"
            class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ !$laporan->onFirstPage() ? '' : 'pointer-events-none opacity-50' }}">
            Previous
        </a>

        <span class="border px-4 py-2 rounded bg-gray-100 font-medium">
            {{ $laporan->currentPage() }}
        </span>

        <a href="{{ $laporan->nextPageUrl() }}"
            class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ $laporan->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
            Next
        </a>

    </div>

</div>

</div>
    </div>

@endsection