@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

@php
$kategori = $kategori ?? collect();
$supplier = $supplier ?? collect();
$brandOptions = $brandOptions ?? collect();
@endphp

<div class="w-full space-y-4">

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="p-4">

            <!-- BUTTON TAMBAH -->
            <button type="button" onclick="openModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">

                <i class="fas fa-plus mr-1"></i>
                Tambah Barang

            </button>
        </div>
        <!-- FILTER -->
        <form method="GET" action="{{ url('/admin/data-barang') }}">

            <div class="px-4 pb-4 flex flex-wrap items-center gap-3">

                <!-- SEARCH -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                    class="w-64 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <!-- BRAND -->
                <select name="brand"
                    class="border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                    <option value="">
                        Semua Brand
                    </option>

                    @foreach($brandOptions as $brand)
                    <option value="{{ $brand->nama_brand }}"
                        {{ request('brand') === $brand->nama_brand ? 'selected' : '' }}>

                        {{ $brand->nama_brand }}

                    </option>
                    @endforeach

                </select>

                <!-- FILTER -->
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <!-- RESET -->
                <a href="{{ url('/admin/data-barang') }}"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">

                    Reset

                </a>

            </div>

        </form>

        <div class="flex justify-between items-center px-4 py-3 border-b bg-white">

            <div class="flex items-center gap-2 text-sm">

                <span>Tampilkan</span>

                <select onchange="window.location='?per_page='+this.value"
                    class="h-10 min-w-[75px] border border-gray-300 rounded-md px-3 pr-8 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="10" {{ request('per_page',10)==10 ? 'selected' : '' }}>
                        10
                    </option>

                    <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>
                        25
                    </option>

                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>
                        50
                    </option>

                </select>

                <span>data</span>

            </div>

        </div>
        <div class="overflow-x-auto">

            <table class="w-full text-sm border-collapse">

                <thead class="bg-slate-100 text-slate-800">
                    <tr>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-16">No</th>

                        <th class="px-4 py-4 text-left text-sm font-bold border">
                            Kode Part
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-bold border">
                            Nama Barang
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-bold border w-48">
                            Kategori
                        </th>

                        <th class="px-4 py-4 text-center text-sm font-bold border w-36">
                            Stok
                        </th>

                        <th class="px-4 py-4 text-right text-sm font-bold border w-44">
                            Harga Jual
                        </th>

                        <th class="px-4 py-4 text-center text-sm font-bold border w-72">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white">

                    @forelse($barangs as $item)

                    @php

                    $stok = (int) $item->stok;

                    if ($stok <= 0) { $stokClass='bg-red-100 text-red-700' ; $stokText='Habis' ; } elseif ($stok <=10) {
                        $stokClass='bg-yellow-100 text-yellow-700' ; $stokText='Menipis' ; } else {
                        $stokClass='bg-green-100 text-green-700' ; $stokText='Aman' ; } @endphp <tr
                        class="hover:bg-slate-50 transition-colors duration-150">

                        <td class="px-4 py-4 border text-center">
                            {{ $barangs->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-4 border">
                            {{ $item->kode }}
                        </td>

                        <td class="px-4 py-4 border font-medium text-slate-800">
                            {{ $item->nama_barang }}
                        </td>

                        <td class="px-4 py-4 border">
                            <span
                                class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        <td class="px-4 py-4 border text-center">

                            <span
                                class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-xs font-semibold {{ $stokClass }}">

                                <span>{{ $item->stok }}</span>

                                <span>|</span>

                                <span>{{ $stokText }}</span>

                            </span>

                        </td>

                        <td class="px-4 py-4 border text-right font-semibold text-slate-700">
                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-4 border">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.data-barang.show', $item->id) }}"
                                    class="px-3 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg shadow-sm transition">

                                    <i class="fas fa-eye mr-1"></i>
                                    Detail

                                </a>

                                <button type="button" data-id="{{ $item->id }}" data-no-part="{{ $item->kode }}"
                                    data-nama-barang="{{ $item->nama_barang }}"
                                    data-kategori-id="{{ $item->kategori_id }}" data-brand-id="{{ $item->brand_id }}"
                                    data-supplier-id="{{ $item->supplier_id }}" data-stok="{{ $item->stok }}"
                                    data-harga="{{ $item->harga_jual }}" data-deskripsi="{{ $item->deskripsi }}"
                                    onclick="editData(this)"
                                    class="px-3 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white transition">

                                    <i class="fas fa-pen mr-1"></i>
                                    Edit

                                </button>

                                <form action="{{ route('admin.data-barang.destroy', $item->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete(this.form)"
                                        class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition">

                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="py-10 text-center text-gray-500">
                                Belum ada data barang
                            </td>

                        </tr>

                        @endforelse

                </tbody>
            </table>
        </div>

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 px-5 py-4 border-t bg-slate-50">

            <div class="text-sm text-slate-600">

                Menampilkan

                <span class="font-semibold text-slate-800">
                    {{ $barangs->firstItem() ?? 0 }}
                </span>

                -

                <span class="font-semibold text-slate-800">
                    {{ $barangs->lastItem() ?? 0 }}
                </span>

                dari

                <span class="font-semibold text-blue-600">
                    {{ $barangs->total() }}
                </span>

                data barang

            </div>

            <div class="flex items-center gap-2">

                <a href="{{ $barangs->previousPageUrl() }}" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-100 transition
            {{ $barangs->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">

                    Sebelumnya

                </a>

                <span
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold">

                    {{ $barangs->currentPage() }}

                </span>

                <a href="{{ $barangs->nextPageUrl() }}" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-100 transition
            {{ !$barangs->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">

                    Berikutnya

                </a>

            </div>

        </div>
    </div>

    <!-- MODAL BARANG -->
    <div id="modalBarang" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 overflow-y-auto">
        <div class="bg-white w-full max-w-4xl rounded-xl shadow-2xl border border-slate-200 overflow-hidden max-h-[88vh] flex flex-col"
            onclick="event.stopPropagation()">

            <!-- HEADER -->
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h2 id="modalTitle" class="text-xl font-bold text-slate-800">
                        Tambah Barang
                    </h2>
                    <p id="modalSubtitle" class="text-sm text-slate-500 mt-1">
                        Lengkapi data barang baru di bawah ini.
                    </p>
                </div>

                <button type="button" onclick="closeModal()"
                    class="w-9 h-9 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-red-500 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- FORM -->
            <form id="formBarang" action="{{ route('admin.data-barang.store') }}" method="POST"
                enctype="multipart/form-data" class="p-6 overflow-y-auto">
                @csrf
                <div id="methodContainer"></div>

                <div class="grid md:grid-cols-2 gap-5">

                    <!-- No Part -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Kode Part
                        </label>
                        <input type="text" name="kode" required placeholder="Contoh: BRG-001"
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Nama Barang -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Nama Barang
                        </label>
                        <input type="text" name="nama_barang" required placeholder="Nama Barang"
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Kategori
                        </label>
                        <select name="kategori_id" required
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Brand
                        </label>
                        <select name="brand_id" required
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                            <option value="">Pilih Brand</option>
                            @foreach($brandOptions as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->nama_brand }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Stok
                        </label>
                        <input type="number" name="stok" required min="0" placeholder="Jumlah Stok"
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Supplier
                        </label>
                        <select name="supplier_id" required
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                            <option value="">Pilih Supplier</option>
                            @foreach($supplier as $s)
                            <option value="{{ $s->id }}">
                                {{ $s->nama_supplier }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga Jual -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Harga Jual
                        </label>
                        <input type="number" name="harga_jual" required min="0" placeholder="Contoh: 100000"
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700">
                            Deskripsi
                            <span class="text-slate-400">(Opsional)</span>
                        </label>
                        <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi barang..."
                            class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Gambar Produk
                        </label>

                        <div
                            class="border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg p-8 text-center hover:border-blue-400 transition">
                            <input type="file" name="gambar[]" multiple accept="image/*"
                                class="w-full text-sm text-slate-700">

                            <p class="mt-2 text-xs text-slate-500">
                                Maksimal 4 gambar (JPG, JPEG, PNG • 2MB per gambar)
                            </p>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="bg-white flex justify-end gap-3 px-6 py-4 border-t border-slate-200">
                    <button type="button" onclick="closeModal()"
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg transition">
                        Batal
                    </button>

                    <button id="submitBtn" type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- MODAL PREVIEW GAMBAR -->
<div id="imageModal" class="fixed inset-0 bg-black/80 z-[9999] hidden items-center justify-center p-5">

    <button onclick="closeImage()" class="absolute top-5 right-6 text-white text-5xl">

        &times;

    </button>

    <img id="previewImage" src="" class="max-w-[420px] w-full max-h-[70vh] object-contain border-4 border-white">

</div>

@endsection