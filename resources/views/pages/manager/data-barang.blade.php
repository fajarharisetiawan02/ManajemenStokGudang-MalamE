@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

@php
$kategori = $kategori ?? collect();
$supplier = $supplier ?? collect();
$brandOptions = $brandOptions ?? collect();
@endphp

<div class="w-full space-y-4">

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4">
            <!-- FILTER -->
            <form method="GET" action="{{ route('manager.data-barang.index') }}">

                <div class="px-4 pb-4 flex flex-wrap items-center gap-3">

                    <!-- SEARCH -->
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                        class="w-64 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <!-- BRAND -->
                    <select name="brand"
                        class="border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                        <option value="">
                            Semua Brand
                        </option>

                        @foreach($brandOptions as $brand)
                        <option value="{{ $brand->nama_brand }}"
                            {{ request('brand') === $brand->nama_brand ? 'selected' : '' }}>

                            {{ $brand->nama_brand }}

                        </option>
                        @endforeach

                    </select>

                    <!-- FILTER -->
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">

                        <i class="fas fa-filter mr-1"></i>
                        Filter

                    </button>

                    <!-- RESET -->
                    <a href="{{ route('manager.data-barang.index') }}"
                        class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">

                        Reset

                    </a>

                </div>

            </form>

            <div class="flex justify-between items-center px-4 py-3 border-b bg-white">

                <div class="flex items-center gap-2 text-sm">

                    <span>Show</span>

                    <select onchange="window.location='?per_page='+this.value"
                        class="h-10 min-w-[75px] border border-gray-300 rounded-md px-3 pr-8 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="10" {{ request('per_page',10)==10 ? 'selected' : '' }}>
                            10
                        </option>

                        <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>
                            25
                        </option>

                        <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>
                            50
                        </option>

                    </select>

                    <span>entries</span>

                </div>

            </div>
            <div class="overflow-x-auto">

                <table class="w-full text-sm border-collapse">

                    <thead class="bg-slate-50 text-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold border">No</th>
                            <th class="px-4 py-3 text-left font-semibold border">Kode Part</th>
                            <th class="px-4 py-3 text-left font-semibold border">Nama Barang</th>
                            <th class="px-4 py-3 text-left font-semibold border">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold border">Stok</th>
                            <th class="px-4 py-3 text-left font-semibold border">Harga</th>
                            <th class="px-4 py-3 text-center font-semibold border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">

                        @forelse($barangs as $item)

                        @php
                        $stok = (int) $item->stok;

                        if ($stok <= 0) { $stokClass='bg-red-100 text-red-700' ; } elseif ($stok <=5) {
                            $stokClass='bg-yellow-100 text-yellow-700' ; } else {
                            $stokClass='bg-green-100 text-green-700' ; } @endphp <tr class="hover:bg-gray-50">

                            <td class="px-4 py-4 border">
                                {{ $barangs->firstItem() + $loop->index }}
                            </td>

                            <td class="px-4 py-4 border">
                                {{ $item->kode }}
                            </td>

                            <td class="px-4 py-4 border font-medium">
                                {{ $item->nama_barang }}
                            </td>

                            <td class="px-4 py-4 border">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-4 border">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $stokClass }}">
                                    {{ $item->stok }}
                                </span>
                            </td>

                            <td class="px-4 py-4 border">
                                Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-4 border">

                                <div class="flex justify-center">

                                    <a href="{{ route('manager.data-barang.show', $item->id) }}"
                                        class="px-3 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg shadow-sm transition">

                                        <i class="fas fa-eye mr-1"></i>
                                        Detail

                                    </a>

                                </div>

                            </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="6" class="py-10 text-center text-gray-500">
                                    Belum ada data barang
                                </td>
                            </tr>

                            @endforelse

                    </tbody>

                </table>
            </div>

            <div class="flex justify-between items-center px-4 py-3 border-t bg-white">

                <div class="text-sm text-gray-600">
                    Showing
                    {{ $barangs->firstItem() ?? 0 }}
                    to
                    {{ $barangs->lastItem() ?? 0 }}
                    of
                    {{ $barangs->total() }}
                    entries
                </div>

                <div class="flex items-center gap-2">

                    <a href="{{ $barangs->previousPageUrl() }}"
                        class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ !$barangs->onFirstPage() ? '' : 'pointer-events-none opacity-50' }}">
                        Previous
                    </a>

                    <span class="border px-4 py-2 rounded bg-gray-100 font-medium">
                        {{ $barangs->currentPage() }}
                    </span>

                    <a href="{{ $barangs->nextPageUrl() }}"
                        class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ $barangs->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
                        Next
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection