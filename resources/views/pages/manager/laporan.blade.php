@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

<div class="w-full space-y-5">

    {{-- FILTER + EXPORT --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        {{-- BARIS 1: EXPORT --}}
        <div class="px-5 pt-5 pb-3 flex items-center gap-2">
            <a href="{{ route('manager.laporan.export-excel') }}?dari={{ $dari }}&sampai={{ $sampai }}&jenis={{ $jenis }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="{{ route('manager.laporan.export-pdf') }}?dari={{ $dari }}&sampai={{ $sampai }}&jenis={{ $jenis }}"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
        </div>

        {{-- GARIS PEMISAH --}}
        <div class="border-t border-slate-100 mx-5"></div>

        {{-- BARIS 2: FILTER --}}
        <form method="GET" action="{{ route('manager.laporan.index') }}" class="px-5 py-4">
            <div class="flex flex-wrap gap-3 items-center">

                <div class="flex items-center gap-2">
                    <label class="text-sm text-slate-600 whitespace-nowrap">Dari</label>
                    <input type="date" name="dari" value="{{ $dari }}"
                        class="px-4 py-2.5 border border-slate-300 rounded-lg text-sm outline-none
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex items-center gap-2">
                    <label class="text-sm text-slate-600 whitespace-nowrap">Sampai</label>
                    <input type="date" name="sampai" value="{{ $sampai }}"
                        class="px-4 py-2.5 border border-slate-300 rounded-lg text-sm outline-none
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <select name="jenis"
                    class="px-4 py-2.5 border border-slate-300 rounded-lg text-sm outline-none
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="semua" {{ $jenis === 'semua' ? 'selected' : '' }}>Semua Transaksi</option>
                    <option value="masuk" {{ $jenis === 'masuk' ? 'selected' : '' }}>Barang Masuk</option>
                    <option value="keluar" {{ $jenis === 'keluar' ? 'selected' : '' }}>Barang Keluar</option>
                </select>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>

                <a href="{{ route('manager.laporan.index') }}"
                    class="border border-slate-300 hover:bg-slate-50 px-5 py-2.5 rounded-lg text-sm transition">
                    Reset
                </a>

            </div>
        </form>

    </div>

    {{-- CARD SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm overflow-hidden">
            <div class="h-1 bg-green-500 -mx-5 -mt-5 mb-5"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Total Barang Masuk</p>
                    <h3 class="text-4xl font-bold text-green-600 mt-3">{{ number_format($totalMasuk) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Periode yang dipilih</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="fas fa-arrow-down text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm overflow-hidden">
            <div class="h-1 bg-red-500 -mx-5 -mt-5 mb-5"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Total Barang Keluar</p>
                    <h3 class="text-4xl font-bold text-red-600 mt-3">{{ number_format($totalKeluar) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Periode yang dipilih</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                    <i class="fas fa-arrow-up text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm overflow-hidden">
            <div class="h-1 bg-blue-500 -mx-5 -mt-5 mb-5"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Stok Akhir</p>
                    <h3 class="text-4xl font-bold text-blue-600 mt-3">{{ number_format($stokAkhir) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Total stok tersedia</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-box text-blue-600"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-slate-100 text-slate-800">
                    <tr>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-16">No</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Tanggal</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">No Transaksi</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Kode Part</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Nama Barang</th>
                        <th class="px-4 py-4 text-center text-sm font-bold border">Jenis</th>
                        <th class="px-4 py-4 text-center text-sm font-bold border">Qty</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($laporan as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-4 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-4 border">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                        <td class="px-4 py-4 border font-medium text-slate-700">{{ $item->no }}</td>
                        <td class="px-4 py-4 border">{{ $item->kode ?? '-' }}</td>
                        <td class="px-4 py-4 border font-medium text-slate-800">{{ $item->barang }}</td>
                        <td class="px-4 py-4 border text-center">
                            @if($item->jenis === 'Masuk')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                <i class="fas fa-arrow-down mr-1"></i> Masuk
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                <i class="fas fa-arrow-up mr-1"></i> Keluar
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 border text-center font-semibold
                            {{ $item->jenis === 'Masuk' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $item->jenis === 'Masuk' ? '+' : '-' }}{{ $item->jumlah }}
                        </td>
                        <td class="px-4 py-4 border text-slate-500">{{ $item->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-10 text-center text-slate-400">
                            <i class="fas fa-inbox text-3xl mb-3 block text-slate-300"></i>
                            Belum ada data laporan untuk periode ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 px-5 py-4 border-t bg-slate-50">
            <div class="text-sm text-slate-600">
                Menampilkan
                <span class="font-semibold text-slate-800">{{ $laporan->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold text-slate-800">{{ $laporan->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-blue-600">{{ $laporan->total() }}</span>
                data transaksi
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ $laporan->previousPageUrl() }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ $laporan->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                    Sebelumnya
                </a>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold text-xs">
                    {{ $laporan->currentPage() }}
                </span>
                <a href="{{ $laporan->nextPageUrl() }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ !$laporan->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
                    Berikutnya
                </a>
            </div>
        </div>

    </div>

</div>

@endsection