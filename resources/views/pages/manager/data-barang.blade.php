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

        <!-- FILTER -->
        <form method="GET" action="{{ url('/manager/data-barang') }}">

            <div class="p-4 flex flex-wrap items-center gap-3">

                <!-- SEARCH -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                    class="w-64 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <!-- BRAND -->
                <select name="brand"
                    class="border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Brand</option>
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
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>

                <!-- RESET -->
                <a href="{{ url('/manager/data-barang') }}"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">
                    Reset
                </a>

            </div>

        </form>

        <div class="flex justify-between items-center px-4 py-3 border-b bg-white">
            <div class="flex items-center gap-2 text-sm">
                <span>Tampilkan</span>
                <select onchange="window.location='?per_page='+this.value"
                    class="h-10 min-w-[75px] border border-gray-300 rounded-md px-3 pr-8 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="10" {{ request('per_page',10)==10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                </select>
                <span>data</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-slate-100 text-slate-800">
                    <tr>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-16">No</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Kode Part</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Nama Barang</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border w-48">Kategori</th>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-36">Stok</th>
                        <th class="px-4 py-4 text-right text-sm font-bold border w-44">Harga Jual</th>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-36">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse($barangs as $item)
                    @php
                        $stok = (int) $item->stok;
                        if ($stok <= 0)       { $stokClass = 'bg-red-100 text-red-700';     $stokText = 'Habis';   }
                        elseif ($stok <= 10)  { $stokClass = 'bg-yellow-100 text-yellow-700'; $stokText = 'Menipis'; }
                        else                  { $stokClass = 'bg-green-100 text-green-700';  $stokText = 'Aman';    }
                    @endphp
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-4 py-4 border text-center">{{ $barangs->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-4 border">{{ $item->kode }}</td>
                        <td class="px-4 py-4 border font-medium text-slate-800">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-4 border">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 border text-center">
                            <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-xs font-semibold {{ $stokClass }}">
                                <span>{{ $item->stok }}</span>
                                <span>|</span>
                                <span>{{ $stokText }}</span>
                            </span>
                        </td>
                        <td class="px-4 py-4 border text-right font-semibold text-slate-700">
                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-4 border">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('manager.data-barang.show', $item->id) }}"
                                    class="px-3 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg shadow-sm transition">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-500">Belum ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 px-5 py-4 border-t bg-slate-50">
            <div class="text-sm text-slate-600">
                Menampilkan
                <span class="font-semibold text-slate-800">{{ $barangs->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold text-slate-800">{{ $barangs->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-blue-600">{{ $barangs->total() }}</span>
                data barang
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ $barangs->previousPageUrl() }}" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-100 transition
                    {{ $barangs->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                    Sebelumnya
                </a>
                <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold">
                    {{ $barangs->currentPage() }}
                </span>
                <a href="{{ $barangs->nextPageUrl() }}" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-100 transition
                    {{ !$barangs->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
                    Berikutnya
                </a>
            </div>
        </div>

    </div>

</div>

@endsection