@extends('layouts.app')

@section('title', 'Laporan')

@section('icon')
<i class="fas fa-file-alt text-blue-600"></i>
@endsection

@section('content')

<!-- FILTER -->
<div class="flex flex-wrap justify-between items-center gap-4 mb-6">

    <div class="flex flex-wrap items-center gap-3">

        <!-- TANGGAL -->
        <input type="date"
            class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">

        <span>-</span>

        <input type="date"
            class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">

        <!-- JENIS -->
        <select class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
            <option>Semua Transaksi</option>
            <option>Barang Masuk</option>
            <option>Barang Keluar</option>
        </select>

        <!-- BUTTON -->
        <button class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow">
            <i class="fas fa-filter mr-2"></i> Filter
        </button>

        <button class="bg-gray-200 px-4 py-2 rounded-xl">
            Reset
        </button>

    </div>

    <!-- EXPORT -->
    <div class="flex gap-2">
        <button class="bg-green-600 text-white px-4 py-2 rounded-xl shadow">
            <i class="fas fa-file-excel mr-2"></i> Excel
        </button>

        <button class="bg-red-500 text-white px-4 py-2 rounded-xl shadow">
            <i class="fas fa-file-pdf mr-2"></i> PDF
        </button>
    </div>

</div>

<!-- SUMMARY -->
<div class="grid md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Total Barang Masuk</p>
        <h2 class="text-2xl font-bold text-green-600 mt-2">120</h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Total Barang Keluar</p>
        <h2 class="text-2xl font-bold text-red-500 mt-2">80</h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Stok Akhir</p>
        <h2 class="text-2xl font-bold text-blue-600 mt-2">40</h2>
    </div>

</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">No Transaksi</th>
                <th class="px-4 py-3 text-left">Barang</th>
                <th class="px-4 py-3 text-left">Jenis</th>
                <th class="px-4 py-3 text-center">Jumlah</th>
                <th class="px-4 py-3 text-left">Keterangan</th>
            </tr>
        </thead>

        <tbody>

            <tr class="border-t hover:bg-blue-50 even:bg-slate-50">
                <td class="px-4 py-3">26-04-2026</td>
                <td class="px-4 py-3 font-mono text-xs">TRX-001</td>
                <td class="px-4 py-3">Oli Mesin</td>

                <td class="px-4 py-3">
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs">
                        Masuk
                    </span>
                </td>

                <td class="px-4 py-3 text-center font-semibold">+50</td>
                <td class="px-4 py-3 text-gray-500">Pembelian</td>
            </tr>

            <tr class="border-t hover:bg-blue-50 even:bg-slate-50">
                <td class="px-4 py-3">26-04-2026</td>
                <td class="px-4 py-3 font-mono text-xs">TRX-002</td>
                <td class="px-4 py-3">Ban Mobil</td>

                <td class="px-4 py-3">
                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded-lg text-xs">
                        Keluar
                    </span>
                </td>

                <td class="px-4 py-3 text-center font-semibold">-20</td>
                <td class="px-4 py-3 text-gray-500">Penjualan</td>
            </tr>

        </tbody>
    </table>

</div>

@endsection