@extends('layouts.app')

@section('title', 'Supplier')

@section('icon')
<i class="fas fa-truck text-blue-600"></i>
@endsection

@section('content')


<!-- FILTER -->
<div class="flex flex-wrap justify-between items-center gap-4 mb-6">

    <!-- LEFT -->
    <div class="flex flex-wrap items-center gap-3">

        <!-- SEARCH -->
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            <input type="text" placeholder="Cari supplier..."
                class="pl-10 pr-4 py-2 border rounded-xl w-64 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- FILTER -->
        <select class="px-4 py-2 border rounded-xl shadow-sm">
            <option>Semua Supplier</option>
        </select>

        <!-- RESET -->
        <button class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
            Reset
        </button>

    </div>

    <!-- RIGHT -->
    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition">
        <i class="fas fa-plus mr-2"></i> Tambah Supplier
    </button>

</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Nama Supplier</th>
                <th class="px-4 py-3 text-left">Telepon</th>
                <th class="px-4 py-3 text-left">Alamat</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>

            <!-- SAMPLE -->
            <tr class="border-t hover:bg-blue-50 even:bg-slate-50 transition">
                <td class="px-4 py-3">1</td>
                <td class="px-4 py-3 font-semibold">PT Astra</td>
                <td class="px-4 py-3">0812-3456-7890</td>
                <td class="px-4 py-3">Jakarta</td>

                <td class="px-4 py-3 text-center">
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs font-semibold">
                        Aktif
                    </span>
                </td>

                <td class="px-4 py-3">
                    <div class="flex justify-center gap-2">
                        <button class="bg-yellow-400 text-white px-3 py-1 rounded-lg">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>

</div>

@endsection