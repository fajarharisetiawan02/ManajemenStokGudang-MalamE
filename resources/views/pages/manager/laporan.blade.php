@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

<!-- ================= FILTER CARD ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4 mb-4">

    <div class="flex flex-wrap justify-between items-center gap-3">

        <!-- FILTER -->
        <div class="flex flex-wrap items-center gap-3">

            <input type="date"
                class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">

            <span>-</span>

            <input type="date"
                class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">

            <select class="px-4 py-2 border border-gray-300 rounded-xl">
                <option>Semua Transaksi</option>
                <option>Barang Masuk</option>
                <option>Barang Keluar</option>
            </select>

            <button class="bg-blue-600 text-white px-5 py-2 rounded-xl flex items-center gap-2">
                <i class="fas fa-filter text-sm"></i>
                Filter
            </button>

            <button class="bg-gray-200 px-4 py-2 rounded-xl">
                Reset
            </button>

        </div>

        <!-- EXPORT -->
        <div class="flex gap-2">
            <button class="bg-green-600 text-white px-4 py-2 rounded-xl flex items-center gap-2">
                <i class="fas fa-file-excel text-sm"></i>
                Excel
            </button>

            <button class="bg-red-500 text-white px-4 py-2 rounded-xl flex items-center gap-2">
                <i class="fas fa-file-pdf text-sm"></i>
                PDF
            </button>
        </div>

    </div>

</div>


<!-- ================= SUMMARY ================= -->
<div class="grid md:grid-cols-3 gap-4 mb-4">

    <div class="bg-white p-5 rounded-2xl shadow-md border border-gray-100">
        <p class="text-sm text-gray-500">Total Barang Masuk</p>
        <h2 class="text-2xl font-bold text-green-600 mt-2">120</h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-md border border-gray-100">
        <p class="text-sm text-gray-500">Total Barang Keluar</p>
        <h2 class="text-2xl font-bold text-red-500 mt-2">80</h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-md border border-gray-100">
        <p class="text-sm text-gray-500">Stok Akhir</p>
        <h2 class="text-2xl font-bold text-blue-600 mt-2">40</h2>
    </div>

</div>


<!-- ================= TABLE ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-blue-600 text-white text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">No Transaksi</th>
                    <th class="px-4 py-3 text-left">Barang</th>
                    <th class="px-4 py-3 text-left">Jenis</th>
                    <th class="px-4 py-3 text-center">Jumlah</th>
                    <th class="px-4 py-3 text-left">Keterangan</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>

                <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100">

                    <td class="px-4 py-3 text-center">1</td>
                    <td class="px-4 py-3">26-04-2026</td>
                    <td class="px-4 py-3 font-mono text-xs">TRX-001</td>
                    <td class="px-4 py-3">Oli Mesin</td>

                    <td class="px-4 py-3">
                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                            Masuk
                        </span>
                    </td>

                    <td class="px-4 py-3 text-center font-semibold text-green-600">+50</td>
                    <td class="px-4 py-3 text-gray-500">Pembelian</td>

                </tr>

                <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100">

                    <td class="px-4 py-3 text-center">2</td>
                    <td class="px-4 py-3">26-04-2026</td>
                    <td class="px-4 py-3 font-mono text-xs">TRX-002</td>
                    <td class="px-4 py-3">Ban Mobil</td>

                    <td class="px-4 py-3">
                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs">
                            Keluar
                        </span>
                    </td>

                    <td class="px-4 py-3 text-center font-semibold text-red-500">-20</td>
                    <td class="px-4 py-3 text-gray-500">Penjualan</td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection