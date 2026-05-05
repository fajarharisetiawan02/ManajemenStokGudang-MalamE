@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

<!-- FILTER -->
<div class="bg-white rounded-2xl shadow-sm border p-4 mb-4 flex justify-between items-center flex-wrap gap-3">

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

<!-- LIST KATEGORI -->
<div class="bg-white rounded-2xl shadow-sm border divide-y">

    @forelse($kategori as $item)
    <a href="/admin/data-barang?kategori={{ $item->nama }}"
       class="flex items-center justify-between px-5 py-4 hover:bg-gray-50 transition group">

        <!-- LEFT -->
        <div class="flex items-center gap-4">

            <!-- ICON -->
            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                <i class="fas fa-box"></i>
            </div>

            <!-- TEXT -->
            <div>
                <div class="font-semibold text-gray-800 group-hover:text-blue-600">
                    {{ $item->nama }}
                </div>

                <div class="text-xs text-gray-400">
                    {{ ucfirst($item->kelompok) }}
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-4">

            <!-- JUMLAH -->
            <div class="text-right">
                <div class="font-bold text-gray-700">
                    {{ $item->jumlah }}
                </div>
                <div class="text-xs text-gray-400">
                    barang
                </div>
            </div>

            <!-- STATUS -->
            <span class="px-2 py-1 text-xs rounded-lg font-semibold
                {{ $item->status == 'aktif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                {{ ucfirst($item->status) }}
            </span>

            <!-- ARROW -->
            <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500"></i>

        </div>

    </a>

    @empty
    <div class="text-center py-10 text-gray-400">
        <i class="fas fa-folder-open text-3xl mb-2"></i><br>
        Belum ada kategori
    </div>
    @endforelse

</div>

@endsection