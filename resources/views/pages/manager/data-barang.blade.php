@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
@php
    $brandOptions = ['Honda', 'Toyota', 'Daihatsu', 'Suzuki'];
@endphp

<div class="w-full space-y-4">

    <!-- FILTER CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="p-4 flex flex-wrap items-center gap-3 w-full">
            <form method="GET" action="{{ url('/manager/data-barang') }}" class="flex flex-wrap items-center gap-3 w-full xl:w-auto">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari barang..."
                        class="pl-9 pr-4 py-2.5 w-64 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <select
                    name="brand"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Semua Brand</option>
                    @foreach($brandOptions as $brand)
                        <option value="{{ $brand }}" {{ request('brand') === $brand ? 'selected' : '' }}>
                            {{ $brand }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm flex items-center gap-2 transition">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ url('/manager/data-barang') }}"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                    Reset
                </a>
            </form>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[1100px] text-[15px]">
                <thead class="bg-blue-600 text-white text-[13px] uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-4 text-left font-semibold">No</th>
                        <th class="px-4 py-4 text-left font-semibold">No Part</th>
                        <th class="px-4 py-4 text-left font-semibold">Nama</th>
                        <th class="px-4 py-4 text-left font-semibold">Kategori</th>
                        <th class="px-4 py-4 text-left font-semibold">Brand</th>
                        <th class="px-4 py-4 text-center font-semibold">Stok</th>
                        <th class="px-4 py-4 text-left font-semibold">Harga</th>
                        <th class="px-4 py-4 text-left font-semibold">Supplier</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($barang as $item)
                        @php
                            $stok = (int) $item->stok;

                            if ($stok <= 0) {
                                $stokClass = 'text-red-600 bg-red-50 border-red-100';
                                $stokText = 'Habis';
                            } elseif ($stok <= 5) {
                                $stokClass = 'text-amber-700 bg-amber-50 border-amber-100';
                                $stokText = 'Menipis';
                            } else {
                                $stokClass = 'text-emerald-700 bg-emerald-50 border-emerald-100';
                                $stokText = 'Aman';
                            }
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-gray-500 text-[15px]">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4 font-mono text-sm text-gray-700">
                                {{ $item->no_part }}
                            </td>

                            <td class="px-4 py-4 font-semibold text-gray-800 text-[15px]">
                                {{ $item->nama_barang }}
                            </td>

                            <td class="px-4 py-4 text-gray-600 text-[15px]">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </td>

                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $item->brand }}
                                </span>
                            </td>

                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex flex-col items-center px-3 py-2 rounded-lg border {{ $stokClass }}">
                                    <span class="font-semibold text-[15px] leading-none">
                                        {{ $item->stok }}
                                    </span>
                                    <span class="text-[12px] leading-none mt-1">
                                        {{ $stokText }}
                                    </span>
                                </span>
                            </td>

                            <td class="px-4 py-4 text-gray-800 text-[15px]">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-4 text-gray-600 text-[15px]">
                                {{ $item->supplier->nama_supplier ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-14">
                                <div class="flex flex-col items-center text-center text-gray-500">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-box-open text-2xl text-gray-400"></i>
                                    </div>

                                    <p class="font-medium text-gray-700 text-[15px]">
                                        Belum ada data barang
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Klik “Tambah Barang” untuk mulai input data.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-t border-gray-200 bg-white">
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <span>Page</span>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>
                    <div class="w-12 h-8 border border-gray-300 flex items-center justify-center bg-white text-gray-700">
                        1
                    </div>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>

                <span>of 1</span>

                <div class="flex items-center gap-2">
                    <span>View</span>
                    <select class="h-9 w-[90px] px-3 pr-8 border border-gray-300 bg-white text-sm focus:outline-none rounded-md">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                    <span>records</span>
                </div>
            </div>

            <div class="text-sm text-gray-600">
                Found total {{ count($barang) }} records
            </div>
        </div>
    </div>
</div>
@endsection