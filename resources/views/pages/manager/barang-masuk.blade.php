@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

@php
    $supplierOptions = ['PT Denso', 'PT Astra'];
@endphp

<div class="w-full space-y-4">

    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-5 border-b border-gray-100 flex flex-wrap items-center gap-3">
            <input type="text" placeholder="Cari kode atau nama barang..."
                class="flex-1 min-w-[220px] px-4 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">

            <select
                class="px-4 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                <option>Semua Supplier</option>
                @foreach($supplierOptions as $supplier)
                    <option>{{ $supplier }}</option>
                @endforeach
            </select>

            <button class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl transition">
                Export
            </button>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[1000px] text-[15px]">
                <thead class="bg-blue-600 text-white text-[13px] uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-4 text-center font-semibold">No</th>
                        <th class="px-4 py-4 text-left font-semibold">Tanggal</th>
                        <th class="px-4 py-4 text-left font-semibold">Kode</th>
                        <th class="px-4 py-4 text-left font-semibold">Nama Barang</th>
                        <th class="px-4 py-4 text-center font-semibold">Jumlah</th>
                        <th class="px-4 py-4 text-left font-semibold">Supplier</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($barangMasuk as $item)
                        <tr class="hover:bg-blue-50/40 transition duration-200">
                            <td class="px-4 py-4 text-center text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4 text-gray-700">
                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-4 font-mono text-sm text-gray-700">
                                {{ $item['kode'] }}
                            </td>

                            <td class="px-4 py-4 font-semibold text-gray-800">
                                {{ $item['nama'] }}
                            </td>

                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex px-3 py-1 rounded-md bg-blue-50 text-blue-700 border border-blue-100 font-semibold">
                                    {{ $item['jumlah'] }}
                                </span>
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $item['supplier'] }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-14">
                                <div class="flex flex-col items-center text-center text-gray-500">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-box-open text-2xl text-gray-400"></i>
                                    </div>

                                    <p class="font-medium text-gray-700 text-[15px]">
                                        Belum ada data barang masuk
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Data barang masuk akan muncul di sini.
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
                Found total {{ count($barangMasuk) }} records
            </div>
        </div>
    </div>
</div>

@endsection