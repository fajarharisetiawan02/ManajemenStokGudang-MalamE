@extends('layouts.app')

@section('title', 'Supplier')

@section('icon')
<i class="fas fa-truck text-blue-600"></i>
@endsection

@section('content')

<!-- ================= FILTER CARD ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4 mb-4">

    <div class="flex flex-wrap justify-between items-center gap-3">

        <div class="flex flex-wrap items-center gap-3">

            <!-- SEARCH -->
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                <input type="text" placeholder="Cari supplier..."
                    class="pl-9 pr-4 py-2 border border-gray-300 rounded-xl w-64 shadow-sm 
                    focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- STATUS -->
            <select class="px-4 py-2 border border-gray-300 rounded-xl">
                <option>Semua Supplier</option>
                <option>Aktif</option>
                <option>Nonaktif</option>
            </select>

            <!-- RESET -->
            <button class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300">
                Reset
            </button>

        </div>

        <!-- TAMBAH -->
        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg flex items-center gap-2">
            <i class="fas fa-plus text-sm"></i>
            Tambah Supplier
        </button>

    </div>

</div>


<!-- ================= TABLE CARD ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-blue-600 text-white text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Supplier</th>
                    <th class="px-4 py-3 text-left">Telepon</th>
                    <th class="px-4 py-3 text-left">Alamat</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>

                <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition">

                    <td class="px-4 py-3">1</td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        PT Astra
                    </td>

                    <!-- TELEPON -->
                    <td class="px-4 py-3">
                        <a href="tel:081234567890" class="text-blue-600 hover:underline font-medium">
                            0812-3456-7890
                        </a>
                    </td>

                    <!-- ALAMAT -->
                    <td class="px-4 py-3 flex items-center gap-1 text-gray-600">
                        <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                        Jakarta
                    </td>

                    <!-- STATUS -->
                    <td class="px-4 py-3 text-center">
                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
                            Aktif
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-2">

                            <button
                                class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-md hover:bg-yellow-200 flex items-center justify-center">
                                <i class="fas fa-pen text-xs"></i>
                            </button>

                            <button
                                class="w-8 h-8 bg-red-100 text-red-600 rounded-md hover:bg-red-200 flex items-center justify-center">
                                <i class="fas fa-trash text-xs"></i>
                            </button>

                        </div>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection