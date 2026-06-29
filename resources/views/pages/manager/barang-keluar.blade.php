@extends('layouts.app')

@section('title', __('app.title_barang_keluar'))
@section('page_title', __('app.barang_keluar'))

@section('content')

<div class="w-full space-y-4">

    {{-- TABLE CARD --}}
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        {{-- FILTER --}}
        <form method="GET" action="{{ route('manager.barang-keluar.index') }}">
            <div class="px-4 py-4 flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang / tujuan..."
                    class="w-full md:w-64 border border-slate-300 rounded-lg px-4 py-2.5 text-sm
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none
                    placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 text-sm rounded-lg shadow-sm transition">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('manager.barang-keluar.index') }}"
                    class="border border-slate-300 px-4 py-2.5 text-sm rounded-lg hover:bg-slate-50 transition">
                    Reset
                </a>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-slate-100 text-slate-800">
                    <tr>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-12">No</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Tanggal</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Kode Part</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Nama Barang</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Tujuan</th>
                        <th class="px-4 py-4 text-center text-sm font-bold border">Jumlah Keluar</th>
                        <th class="px-4 py-4 text-right text-sm font-bold border">Harga Jual</th>
                        <th class="px-4 py-4 text-right text-sm font-bold border">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($barangKeluars as $item)
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-4 py-4 border text-center text-black">{{ $barangKeluars->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-4 border text-black">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                        <td class="px-4 py-4 border text-black">{{ $item->barang?->kode ?? '-' }}</td>
                        <td class="px-4 py-4 border text-black max-w-xs break-words">{{ $item->barang?->nama_barang ?? '-' }}</td>
                        <td class="px-4 py-4 border text-black max-w-xs break-words">{{ $item->tujuan ?? '-' }}</td>
                        <td class="px-4 py-4 border text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                -{{ $item->jumlah }}
                            </span>
                        </td>
                        <td class="px-4 py-4 border text-right font-semibold text-slate-700">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-4 py-4 border text-right font-semibold text-slate-700">
                            Rp {{ number_format($item->jumlah * $item->harga_jual, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-10 text-center text-slate-400">
                            <i class="fas fa-arrow-up text-3xl mb-3 block text-slate-300"></i>
                            Belum ada data barang keluar
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
                <span class="font-semibold text-slate-800">{{ $barangKeluars->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold text-slate-800">{{ $barangKeluars->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-blue-600">{{ $barangKeluars->total() }}</span>
                data barang keluar
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ $barangKeluars->currentPage() > 1 ? $barangKeluars->url($barangKeluars->currentPage() - 1) : '#' }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ $barangKeluars->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                    Sebelumnya
                </a>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold text-xs">
                    {{ $barangKeluars->currentPage() }}
                </span>
                <a href="{{ $barangKeluars->hasMorePages() ? $barangKeluars->url($barangKeluars->currentPage() + 1) : '#' }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ !$barangKeluars->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
                    Berikutnya
                </a>
            </div>
        </div>

    </div>

</div>

@endsection