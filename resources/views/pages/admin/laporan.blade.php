@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

<div class="w-full space-y-4">

    <!-- FILTER CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="p-5 flex flex-wrap items-center gap-3">

            <input type="date"
                class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

            <span class="text-gray-400">-</span>

            <input type="date"
                class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select
                class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Semua Transaksi</option>
                <option>Barang Masuk</option>
                <option>Barang Keluar</option>
            </select>

            <button
                class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm flex items-center gap-2 transition">
                <i class="fas fa-filter"></i>
                Filter
            </button>

            <button
                class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                Reset
            </button>

            <div class="ml-auto flex gap-2">
                <button
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition">
                    <i class="fas fa-file-excel"></i>
                    Excel
                </button>

                <button
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition">
                    <i class="fas fa-file-pdf"></i>
                    PDF
                </button>
            </div>
        </div>
    </div>

    <!-- SUMMARY CARD -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <p class="text-sm text-gray-500">Total Barang Masuk</p>
            <h3 class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalMasuk }}</h3>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <p class="text-sm text-gray-500">Total Barang Keluar</p>
            <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $totalKeluar }}</h3>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <p class="text-sm text-gray-500">Stok Akhir</p>
            <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ $stokAkhir }}</h3>
        </div>

    </div>

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[1100px] text-[15px]">

                <thead class="bg-blue-600 text-white text-[13px] uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-4 text-center font-semibold">No</th>
                        <th class="px-4 py-4 text-left font-semibold">Tanggal</th>
                        <th class="px-4 py-4 text-left font-semibold">No Transaksi</th>
                        <th class="px-4 py-4 text-left font-semibold">Barang</th>
                        <th class="px-4 py-4 text-center font-semibold">Jenis</th>
                        <th class="px-4 py-4 text-center font-semibold">Jumlah</th>
                        <th class="px-4 py-4 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($laporan as $i => $item)
                        <tr class="{{ $item->jenis === 'Masuk' ? 'hover:bg-blue-50/40' : 'hover:bg-red-50/40' }} transition duration-200">
                            <td class="px-4 py-4 text-center text-gray-500">
                                {{ $i + 1 }}
                            </td>

                            <td class="px-4 py-4 text-gray-700">
                                {{ $item->tanggal }}
                            </td>

                            <td class="px-4 py-4 font-mono text-sm text-gray-700">
                                {{ $item->no }}
                            </td>

                            <td class="px-4 py-4 font-semibold text-gray-800">
                                {{ $item->barang }}
                            </td>

                            <td class="px-4 py-4 text-center">
                                @if($item->jenis === 'Masuk')
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Masuk
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-red-50 text-red-700 border border-red-100">
                                        Keluar
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4 text-center">
                                <span class="font-semibold {{ $item->jenis === 'Masuk' ? 'text-emerald-600' : 'text-red-600' }}">
                                    {{ $item->jumlah }}
                                </span>
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $item->keterangan }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-14">
                                <div class="flex flex-col items-center text-center text-gray-500">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-file-alt text-2xl text-gray-400"></i>
                                    </div>

                                    <p class="font-medium text-gray-700 text-[15px]">
                                        Belum ada data laporan
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Data transaksi akan tampil di sini.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TABLE FOOTER -->
        <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-t border-gray-200 bg-white">
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <span>Page</span>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition rounded-md">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>
                    <div class="w-12 h-8 border border-gray-300 flex items-center justify-center bg-white text-gray-700 rounded-md">
                        1
                    </div>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition rounded-md">
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
                Found total {{ count($laporan ?? []) }} records
            </div>
        </div>
    </div>
</div>

@endsection