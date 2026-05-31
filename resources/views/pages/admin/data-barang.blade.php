@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

@php
$brandOptions = $brandOptions ?? [];
@endphp

<div class="w-full space-y-4">

    <!-- FILTER CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-none shadow-sm">
        <div class="p-4 flex flex-wrap items-center gap-3 w-full">
            <form method="GET" action="{{ route('admin.data-barang.index') }}"
                class="flex flex-wrap items-center gap-3 w-full xl:w-auto">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                        class="pl-9 pr-4 py-2.5 w-64 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <select name="brand"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Brand</option>
                    @foreach($brandOptions as $brand)
                    <option value="{{ $brand->nama_brand }}"
                        {{ request('brand') === $brand->nama_brand ? 'selected' : '' }}>
                        {{ $brand->nama_brand }}
                    </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm flex items-center gap-2 transition">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ route('admin.data-barang.index') }}"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                    Reset
                </a>
            </form>

            <div class="ml-auto">
                <button type="button" onclick="openModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition">
                    <i class="fas fa-plus"></i>
                    Tambah Barang
                </button>
            </div>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-none shadow-sm overflow-hidden">
        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[1100px] text-[15px]">

                <!-- HEADER -->
                <thead class="bg-gray-100 text-gray-700 text-[13px] uppercase tracking-wide border-b border-gray-300">
                    <tr>
                        <th class="px-4 py-4 text-left font-semibold">No</th>
                        <th class="px-4 py-4 text-left font-semibold">No Part</th>
                        <th class="px-4 py-4 text-left font-semibold">Gambar</th>
                        <th class="px-4 py-4 text-left font-semibold">Nama</th>
                        <th class="px-4 py-4 text-left font-semibold">Kategori</th>
                        <th class="px-4 py-4 text-left font-semibold">Brand</th>
                        <th class="px-4 py-4 text-center font-semibold">Stok</th>
                        <th class="px-4 py-4 text-left font-semibold">Harga</th>
                        <th class="px-4 py-4 text-left font-semibold">Supplier</th>
                        <th class="px-4 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($barang as $item)
                    @php
                    $stok = (int) $item->stok;

                    if ($stok <= 0) { $stokClass='text-red-600 bg-red-50 border-red-100' ; $stokText='Habis' ; } elseif
                        ($stok <=5) { $stokClass='text-amber-700 bg-amber-50 border-amber-100' ; $stokText='Menipis' ; }
                        else { $stokClass='text-emerald-700 bg-emerald-50 border-emerald-100' ; $stokText='Aman' ; }
                        @endphp <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-4 text-gray-500 text-[15px]">
                            {{ $barang->firstItem() + $loop->index }} </td>

                        <td class="px-4 py-4 font-mono text-sm text-gray-700">
                            {{ $barang->kode }}
                        </td>

                        <td class="px-4 py-4">
                            @if($item->gambar)
                            <img src="{{ asset('uploads/barang/' . $item->gambar) }}"
                                onclick="showImage('{{ asset('uploads/barang/' . $item->gambar) }}')"
                                class="w-14 h-14 rounded-xl object-cover border border-gray-200 hover:scale-110 hover:shadow-lg transition duration-200 cursor-pointer">
                            @else
                            <div onclick="showNoImage()"
                                class="w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                            @endif
                        </td>

                        <td class="px-4 py-4 font-semibold text-gray-800 text-[15px]">
                            {{ $barang->nama }}
                        </td>

                        <td class="px-4 py-4 text-gray-600 text-[15px]">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </td>

                        <td class="px-5 py-5 text-gray-600 text-[15px]">
                            {{ $item->brand }}
                        </td>

                        <td class="px-4 py-4 text-center">
                            <span
                                class="inline-flex flex-col items-center px-3 py-2 rounded-lg border {{ $stokClass }}">
                                <span class="font-semibold text-[15px] leading-none">
                                    {{ $item->stok }}
                                </span>
                                <span class="text-[12px] leading-none mt-1">
                                    {{ $stokText }}
                                </span>
                            </span>
                        </td>

                        <td class="px-4 py-4 text-gray-800 text-[15px]">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-4 text-gray-600 text-[15px]">
                            {{ $item->supplier->nama_supplier ?? '-' }}
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-2">
                                <button type="button" data-id="{{ $item->id }}" data-no-part="{{ $item->no_part }}"
                                    data-nama-barang="{{ $item->nama_barang }}"
                                    data-kategori-id="{{ $item->kategori_id ?? '' }}" data-brand="{{ $item->brand }}"
                                    data-stok="{{ $item->stok }}" data-harga="{{ $item->harga }}"
                                    data-supplier-id="{{ $item->supplier_id ?? '' }}" onclick="editData(this)"
                                    class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 transition flex items-center justify-center">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>

                                <form action="{{ route('admin.data-barang.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete(this.form)"
                                        class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition flex items-center justify-center">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="py-16">
                                <div class="flex flex-col items-center text-center text-gray-500">
                                    <div
                                        class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-box-open text-2xl text-gray-400"></i>
                                    </div>

                                    <p class="font-medium text-gray-700 text-[15px]">
                                        Belum ada data barang
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1 mb-4">
                                        Klik “Tambah Barang” untuk mulai input data.
                                    </p>

                                    <button type="button" onclick="openModal()"
                                        class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm flex items-center gap-2 transition">
                                        <i class="fas fa-plus"></i>
                                        Tambah Barang
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                </tbody>
            </table>
        </div>

        <!-- TABLE FOOTER -->
        <div
            class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-t border-gray-200 bg-white rounded-none">
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <span>Page</span>

                    <a href="{{ $barang->onFirstPage() ? '#' : $barang->previousPageUrl() }}"
                        class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition flex items-center justify-center {{ $barang->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </a>

                    <div
                        class="w-12 h-8 border border-gray-300 flex items-center justify-center bg-white text-gray-700">
                        {{ $barang->currentPage() }}
                    </div>

                    <a href="{{ $barang->hasMorePages() ? $barang->nextPageUrl() : '#' }}"
                        class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition flex items-center justify-center {{ $barang->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                </div>

                <span>of {{ $barang->lastPage() }}</span>

                <form method="GET" action="{{ route('admin.data-barang.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="brand" value="{{ request('brand') }}">

                    <span>View</span>
                    <select name="per_page" onchange="this.form.submit()"
                        class="h-9 w-[90px] px-3 pr-8 border border-gray-300 bg-white text-sm focus:outline-none rounded-none">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>

                    <span>records</span>
                </form>
            </div>

            <div class="text-sm text-gray-600">
                Found total {{ $barang->total() }} records
            </div>
        </div>
    </div>
</div>

<!-- MODAL BARANG -->
<div id="modalBarang"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto">

    <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl border border-gray-100"
        onclick="event.stopPropagation()">

        <!-- HEADER -->
        <div class="px-7 py-5 border-b border-gray-100 flex items-start justify-between">
            <div>
                <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Tambah Barang</h2>
                <p id="modalSubtitle" class="text-sm text-gray-500 mt-1">
                    Lengkapi data barang baru di bawah ini.
                </p>
            </div>

            <button type="button" onclick="closeModal()"
                class="w-10 h-10 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-700 transition flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- FORM -->
        <form id="formBarang" action="{{ route('admin.data-barang.store') }}" method="POST"
            enctype="multipart/form-data" class="p-7">
            @csrf
            <div id="methodContainer"></div>

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="text-sm font-semibold text-gray-700">No Part</label>
                    <input type="text" name="no_part" required placeholder="Contoh: BRG-001"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" required placeholder="Nama Barang"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Kategori</label>
                    <select name="kategori_id" required
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Brand</label>
                    <select name="brand" required
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                        <option value="">Pilih Brand</option>
                        @foreach($brandOptions as $brand)
                        <option value="{{ $brand->nama_brand }}">{{ $brand->nama_brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Stok</label>
                    <input type="number" name="stok" required min="0" required placeholder="Contoh: Jumlah Stok"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Harga</label>
                    <input type="number" name="harga" required min="0" placeholder="Contoh: 100000"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Supplier</label>
                    <select name="supplier_id" required
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                        <option value="">Pilih Supplier</option>
                        @foreach($supplier as $s)
                        <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Gambar Produk</label>

                    <div
                        class="mt-2 border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50 hover:border-blue-400 transition">
                        <input type="file" name="gambar" accept="image/*" class="w-full text-sm text-gray-500
                            file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0
                            file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer">

                        <div class="mt-4 text-center">
                            <i class="fas fa-image text-3xl text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-500">Upload gambar produk</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG maksimal 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                <button type="button" onclick="closeModal()"
                    class="px-6 py-3 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700">
                    Batal
                </button>

                <button id="submitBtn" type="submit"
                    class="px-7 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                    Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL PREVIEW GAMBAR -->
<div id="imageModal" class="fixed inset-0 bg-black/80 z-[9999] hidden items-center justify-center p-5">
    <button onclick="closeImage()" class="absolute top-5 right-6 text-white text-5xl font-light hover:text-gray-300">
        &times;
    </button>

    <img id="previewImage" src=""
        class="max-w-[420px] w-full max-h-[70vh] object-contain rounded-2xl shadow-2xl border-4 border-white">
</div>


@endsection