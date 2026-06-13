@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<div class="w-full space-y-4">

    {{-- TABLE CARD --}}
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        {{-- FILTER --}}
        <div class="px-4 py-4 border-b border-slate-200">
            <form method="GET" class="flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                    class="w-64 border border-slate-300 rounded-lg px-4 py-2 text-sm
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-lg shadow-sm transition">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('manager.barang-keluar.index') }}"
                    class="border border-slate-300 px-4 py-2 text-sm rounded-lg hover:bg-slate-50 transition">
                    Reset
                </a>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-slate-100 text-slate-800">
                    <tr>
                        <th class="px-4 py-4 text-center font-bold border w-16">No</th>
                        <th class="px-4 py-4 text-left font-bold border w-28">Tanggal</th>
                        <th class="px-4 py-4 text-left font-bold border w-28">Kode Part</th>
                        <th class="px-4 py-4 text-left font-bold border">Nama Barang</th>
                        <th class="px-4 py-4 text-center font-bold border w-28">Jumlah Keluar</th>
                        <th class="px-4 py-4 text-right font-bold border w-32">Harga Jual</th>
                        <th class="px-4 py-4 text-right font-bold border w-36">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($barangKeluars as $item)
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-4 py-4 border text-center">{{ $barangKeluars->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-4 border">{{ $item->tanggal }}</td>
                        <td class="px-4 py-4 border">{{ $item->barang?->kode ?? '-' }}</td>
                        <td class="px-4 py-4 border font-medium text-slate-800">{{ $item->barang?->nama_barang ?? '-' }}</td>
                        <td class="px-4 py-4 border text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                -{{ $item->jumlah }}
                            </span>
                        </td>
                        <td class="px-4 py-4 border text-right">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-4 py-4 border text-right font-semibold text-slate-700">
                            Rp {{ number_format($item->jumlah * $item->harga_jual, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-500">Belum ada data barang keluar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 px-5 py-4 border-t bg-slate-50">
            <div class="text-sm text-slate-600">
                Menampilkan
                <span class="font-semibold text-slate-800">{{ $barangKeluars->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold text-slate-800">{{ $barangKeluars->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-blue-600">{{ $barangKeluars->total() }}</span>
                data barang keluar
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ $barangKeluars->previousPageUrl() }}"
                    class="flex items-center px-4 py-2 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ $barangKeluars->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                    Sebelumnya
                </a>
                <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold text-sm">
                    {{ $barangKeluars->currentPage() }}
                </span>
                <a href="{{ $barangKeluars->nextPageUrl() }}"
                    class="flex items-center px-4 py-2 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ !$barangKeluars->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
                    Berikutnya
                </a>
            </div>
        </div>

    </div>

</div>

@endsection