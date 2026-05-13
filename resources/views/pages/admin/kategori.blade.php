@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

<!-- FILTER -->
<div class="bg-white rounded-2xl shadow-sm border p-4 mb-6 flex justify-between items-center flex-wrap gap-3">

    <div class="flex gap-3 items-center flex-wrap">
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Cari kategori..."
                class="pl-9 pr-4 py-2 border rounded-xl w-64 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
    </div>

    <a href="#"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow">
        <i class="fas fa-plus"></i>
        Tambah
    </a>

</div>

<!-- GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

@php
$styles = [
    'Oli Mesin' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'icon' => 'fa-oil-can'],
    'Ban Mobil' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'icon' => 'fa-circle'],
    'Aki' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'icon' => 'fa-car-battery'],
];
@endphp

@forelse($kategori as $item)
<a href="/admin/data-barang?kategori={{ $item->nama }}"
   class="bg-white rounded-2xl p-5 border hover:border-blue-500 hover:shadow-md transition duration-300 group">

    <!-- TOP -->
    <div class="flex items-center justify-between mb-4">

        <div class="flex items-center gap-3">

            <!-- ICON -->
            <div class="w-11 h-11 flex items-center justify-center rounded-xl 
                {{ $styles[$item->nama]['bg'] ?? 'bg-gray-100' }} 
                {{ $styles[$item->nama]['text'] ?? 'text-gray-600' }}">
                <i class="fas {{ $styles[$item->nama]['icon'] ?? 'fa-box' }}"></i>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 group-hover:text-blue-600">
                    {{ $item->nama }}
                </h3>
                <p class="text-xs text-gray-400">
                    {{ ucfirst($item->kelompok) }}
                </p>
            </div>

        </div>

        <!-- STATUS -->
        <span class="text-xs px-2.5 py-1 rounded-full font-medium
            {{ $item->status == 'aktif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
            {{ ucfirst($item->status) }}
        </span>

    </div>

    <!-- DIVIDER -->
    <div class="border-t pt-4 flex items-center justify-between">

        <!-- JUMLAH -->
        <div>
            <div class="text-2xl font-bold text-gray-800">
                {{ $item->jumlah }}
            </div>
            <div class="text-xs text-gray-400">
                Total Barang
            </div>
        </div>

        <!-- ARROW -->
        <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-100 
            group-hover:bg-blue-100 transition">
            <i class="fas fa-arrow-right text-gray-400 group-hover:text-blue-600"></i>
        </div>

    </div>

</a>

@empty
<div class="col-span-full text-center py-12 text-gray-400">
    <i class="fas fa-folder-open text-4xl mb-3"></i><br>
    Belum ada kategori
</div>
@endforelse

</div>

@endsection