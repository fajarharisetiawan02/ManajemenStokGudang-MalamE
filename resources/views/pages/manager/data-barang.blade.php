@extends('layouts.app')

@section('title', 'Data Barang')

@section('icon')
<i class="fas fa-box text-blue-600"></i>
@endsection

@section('content')

<!-- ================= FILTER CARD ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4 mb-4">

    <div class="flex flex-wrap justify-between items-center gap-3">

        <!-- FILTER -->
        <form method="GET" action="/data-barang" class="flex gap-3 items-center flex-wrap">

            <!-- SEARCH -->
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="pl-9 pr-4 py-2 border border-gray-300 rounded-xl w-64 shadow-sm 
                    focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- BRAND -->
            <select name="brand" class="px-4 py-2 border border-gray-300 rounded-xl">
                <option value="">Semua Brand</option>
                <option {{ request('brand')=='Honda'?'selected':'' }}>Honda</option>
                <option {{ request('brand')=='Toyota'?'selected':'' }}>Toyota</option>
                <option {{ request('brand')=='Daihatsu'?'selected':'' }}>Daihatsu</option>
                <option {{ request('brand')=='Suzuki'?'selected':'' }}>Suzuki</option>
            </select>

            <!-- FILTER BTN -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm flex items-center gap-2">
                <i class="fas fa-filter"></i> Filter
            </button>

            <!-- RESET -->
            <a href="/data-barang" class="px-3 py-2 border rounded-xl text-gray-500 hover:bg-gray-100">
                Reset
            </a>

        </form>

        <!-- ❌ TOMBOL TAMBAH DIHAPUS -->

    </div>

</div>

<!-- ================= TABLE CARD ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4">

    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-blue-600 text-white text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">No Part</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Brand</th>
                    <th class="px-4 py-3 text-center">Stok</th>
                    <th class="px-4 py-3 text-left">Harga</th>
                    <th class="px-4 py-3 text-left">Supplier</th>
                    <!-- ❌ AKSI DIHAPUS -->
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y">

                @forelse($barang as $item)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3">{{ $loop->iteration }}</td>

                    <td class="px-4 py-3 font-mono text-xs">
                        {{ $item->no_part }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        {{ $item->nama_barang }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $item->kategori->nama_kategori ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-lg text-xs font-semibold">
                            {{ $item->brand }}
                        </span>
                    </td>

                    <!-- STOK -->
                    <td class="px-4 py-3 text-center">
                        @if($item->stok <= 0)
                            <span class="text-red-600 font-bold">{{ $item->stok }}</span>
                            <div class="text-xs text-red-400">Habis</div>
                        @elseif($item->stok <= 5)
                            <span class="text-yellow-500 font-bold">{{ $item->stok }}</span>
                            <div class="text-xs text-yellow-400">Menipis</div>
                        @else
                            <span class="text-green-600 font-bold">{{ $item->stok }}</span>
                            <div class="text-xs text-gray-400">Aman</div>
                        @endif
                    </td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $item->supplier->nama_supplier ?? '-' }}
                    </td>

                    <!-- ❌ AKSI DIHAPUS -->

                </tr>

                @empty
                <tr>
                    <td colspan="8" class="text-center py-12 text-gray-400">
                        <i class="fas fa-box-open text-3xl mb-2"></i><br>
                        Belum ada data barang
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>

<!-- ❌ MODAL TAMBAH DIHAPUS -->

@endsection